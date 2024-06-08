<?php

namespace App\Actions;

use App\Models\Ticket;

class CreateOrderItem
{
    public function execute($data, $order)
    {
        foreach ($data as $item) {
            $order->items()->attach($item['ticketId'],
                [
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            //Check stock
            $ticket = Ticket::find($item['ticketId']);
            $ticket->update(['capacity' => $ticket->capacity - $item['quantity']]);
        }
    }
}
