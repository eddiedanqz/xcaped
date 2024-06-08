<?php

namespace App\Actions;

class CreateOrder
{
    public function execute($data, $request)
    {
        $user = auth()->user();

        $order = Order::create([
            'order_no' => 'XCP'.rand(11111111, 99999999),
            'user_id' => $user->id,
            'full_name' => $user->fullname,
            'user_email' => $user->email,
            'event_id' => $request->eventId,
            'grand_total' => $request->total,
            'quantity' => $request->totalQuantity,
        ]);

        return $order;
    }
}
