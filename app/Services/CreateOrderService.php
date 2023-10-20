<?php

namespace App\Services;

use App\Models\Attendee;
use App\Models\Order;
use App\Models\Ticket;
use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\Notification;

class CreateOrderService
{
    public function create($request)
    {
        $user = auth()->user();

        $total = 0;
        $quantity = 0;

        $data = json_decode($request->tickets);
        //  $data = [$request->all()];

        $order = new Order();
        $order->order_no = 'XCP'.rand(11111111, 99999999);
        $order->user_id = $user->id;
        $order->full_name = $user->fullname;
        $order->user_email = $user->email;

        //Calculate total price
        foreach ($data as $ticket) {
            $total += $ticket->total;
            $quantity += $ticket->qty;
            $eventId = $ticket->eventId;
        }

        $order->event_id = $eventId;
        $order->grand_total = $total;
        $order->quantity = $quantity;
        //Save order items
        $order->save();

        //Create order item
        foreach ($data as $item) {
            $order->items()->attach($item->ticketId,
                [
                    'price' => $item->price,
                    'quantity' => $item->qty,
                ]);
            //Check stock
            $ticket = Ticket::find($item->ticketId);
            $ticket->capacity = $ticket->capacity - $item->qty;
            $ticket->update();
        }

        collect($data)->each(function ($item) use ($order, $eventId, $user) {
            for ($i = 0; $i < $item->qty; $i++) {
                $attendee = new Attendee;
                $attendee->order_id = $order->id;
                $attendee->event_id = $eventId;
                $attendee->user_id = $user->id;
                $attendee->ticket_id = $item->ticketId;
                $attendee->fullname = $user->fullname;
                $attendee->email = $user->email;
                $attendee->reference = rand(11111111, 99999999);
                $attendee->save();
            }
        });

        //Send notification
        Notification::send($user, new OrderCreated($order));

        return $order;
    }

    private function createAtendee($data, $order, $eventId, $user)
    {
        $attendees = [];

        foreach ($data as $item) {
            for ($i = 0; $i < $item->qty; $i++) {
                $attendee = new Attendee;
                $attendee->order_id = $order->id;
                $attendee->event_id = $eventId;
                $attendee->user_id = $user->id;
                $attendee->ticket_id = $item->ticketId;
                $attendee->fullname = $user->fullname;
                $attendee->email = $user->email;
                $attendee->reference = rand(11111111, 99999999);
                $attendees[] = $attendee;
            }
        }

        //
        foreach ($attendees as $attendee) {
            $attendee->save();
        }
    }
}
