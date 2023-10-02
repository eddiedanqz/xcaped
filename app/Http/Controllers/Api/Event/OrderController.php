<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CreateOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateOrderService $createOrderService)
    {
        $order = $createOrderService->create($request);
        //
        //redirect()->route('pay', $order);

        return response(['message' => 'Order Created', 'order' => $order], 201);
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

        return response([
            'order' => $order,
        ], 200);
    }

    public function update($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->isPaid = true;
        $order->save();

        return response([
            'order' => $order,
        ], 200);
    }
}
