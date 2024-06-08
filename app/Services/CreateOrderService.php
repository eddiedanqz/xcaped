<?php

namespace App\Services;

use App\Actions\CreateAttendee;
use App\Actions\CreateOrderItem;
use App\Models\Attendee;
use App\Models\Order;
use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\Notification;

class CreateOrderService
{
    public function create($request)
    {
        $user = auth()->user();

        $data = $request->tickets;

        $order = Order::create([
            'order_no' => 'XCP'.rand(11111111, 99999999),
            'user_id' => $user->id,
            'full_name' => $user->fullname,
            'user_email' => $user->email,
            'event_id' => $request->eventId,
            'grand_total' => $request->total,
            'quantity' => $request->totalQuantity,
        ]);

        //Create order item
        $createItem = new CreateOrderItem;
        $createItem->execute($data, $order);

        //Register attendee
        $createAttendee = new CreateAttendee;
        $createAttendee->execute($order, $data, $request->eventId);

        //Send notification
        Notification::send($user, new OrderCreated($order));

        return $order;
    }
}
