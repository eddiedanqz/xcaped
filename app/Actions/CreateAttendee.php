<?php

namespace App\Actions;

use App\Models\Attendee;

class CreateAttendee
{
    public function execute($order, $data, $eventId)
    {
        $user = auth()->user();

        collect($data)->each(function ($item) use ($order, $eventId, $user) {
            for ($i = 0; $i < $item['quantity']; $i++) {
                Attendee::create([
                    'order_id' => $order->id,
                    'event_id' => $eventId,
                    'user_id' => $user->id,
                    'ticket_id' => $item['ticketId'],
                    'fullname' => $user->fullname,
                    'email' => $user->email,
                    'reference' => rand(11111111, 99999999),
                ]);
            }
        });
    }
}
