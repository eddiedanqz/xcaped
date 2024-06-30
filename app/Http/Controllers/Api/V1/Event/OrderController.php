<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CreateOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->events()->orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateOrderService $createOrderService)
    {
        try {
            $order = DB::transaction(function () use ($request, $createOrderService) {

                $order = $createOrderService->Create($request);

                return $order;
            });

            return response(['message' => 'Order Created', 'order' => $order], 201);
        } catch (\Exception $e) {
            return response(['message' => 'Failed to create order'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        auth()->user()->id;
        $order = Order::find($id);

        return response()->json([
            'order' => $order,
        ], 200);
    }

    public function update($id)
    {
        $order = Order::findOrFail($id);
        $order->status = OrderStatus::COMPLETED->value;
        $order->isPaid = true;
        $order->save();

        return response([
            'order' => $order,
        ], 200);
    }
}
