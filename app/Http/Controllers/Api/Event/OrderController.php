<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Attendee;
use Illuminate\Support\Facades\Mail;


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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        //Get Tickets
        // $cartItems = Cart::where('user_id',$userId)->get();

        $total = 0;
        $quantity = 0;
        $eventId;

        $data = [$request->all()];

        $order = new Order();
        $order->order_no = 'XCP'.rand(11111111,99999999);
        $order->user_id = $user->id;
        $order->full_name = $user->fullname;
        $order->user_email = $user->email;
        //Calculate total price
        foreach ($data as $ticket)
        {
            $total += $ticket['total'];
            $quantity += $ticket['qty'];
            $eventId = $ticket['eventId'];
        }

        $order->event_id = $eventId;
        $order->grand_total = $total;
        $order->quantity = $quantity;

        $order->save();

        //Save order items


        //Create order item
        foreach ($data as $item)
        {
         $order->items()->attach($item['ticketId'],
            [
                'price' => $item['price'],
                'quantity'=> $item['qty']
            ]);
            //Check stock
            $ticket = Ticket::find($item['ticketId']);
            $ticket->capacity = $ticket->capacity - $item['qty'];
            $ticket->update();
        }

        //Send email to customers
        foreach ($data as $item) {
           $attendee = new Attendee;
           $attendee->order_id = $order->id;
           $attendee->event_id = $eventId;
           $attendee->ticket_id = $item['ticketId'];
           $attendee->fullname = $user->fullname;
           $attendee->email = $user->email;
           $attendee->reference = rand(11111111,99999999);
           $attendee->save();
        }

        //
        $response =  [
            'message' => 'Order placed succesfully',
          ];

          return response($response,200);
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
}
