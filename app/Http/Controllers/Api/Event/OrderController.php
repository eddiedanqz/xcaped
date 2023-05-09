<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Order;
use App\Services\CreateOrderService;
use App\Models\Ticket;
use App\Models\Attendee;

=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD

=======
        $userId = auth()->user()->id;

        $orders = Order::where('user_id',$userId)->latest()->get();

        $response = [
            'orders' => $orders
        ];

        return response($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function store(Request $request,CreateOrderService $createOrderService)
    {
          $createOrderService->create($request);
          return response(['message' => 'Order Created'],200);
=======
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        //Get Tickets
        $cartItems = Cart::where('user_id',$userId)->get();

        $total = 0;

        $order = new Order();
        $order->order_no = 'xcp'.rand(11111111,99999999);
        $order->user_id = $userId;
        $order->full_name = $request->full_name;
        $order->user_email = $request->user_email;
        //Calculate total price
        foreach ($cartItems as $prod)
        {
          $total += $prod->product->regular_price;
        }

        $order->grand_total = $total;

        $order->save();

        //Save order items


        //Create order item
        foreach ($cartItems as $item)
        {
         $order->items()->attach($item->product->id,
            [
                'price' => $item->product->regular_price,
                'quantity'=> $item->quantity
            ]);
            //Check stock
            $product = Product::find($item->product->id);
            $product->quantity = $product->quantity - $item->quantity;
            $product->update();
        }

        //Empty cart
        // Cart::destroy($cartItems);

        //Send email to customers

        //
        $response =  [
            'message' => 'Order placed succesfully',
          ];

          return response($response,200);
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
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

<<<<<<< HEAD
        return response([
            'order' => $order
        ],200);
    }

=======
        $response = [
            'order' => $order
        ];

        return response($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
}
