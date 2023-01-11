<?php
namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Str;

class CreateTicketService {

    public function create($event,$request)
    {
        $tickets = json_decode($request);
       $event_id = $event->id;

        //   return $tickets;
       foreach ($tickets as $req) {
            $ticket = new Ticket;
            $ticket->title = $req->title;
            $ticket->price = $req->price;
            $ticket->capacity = $req->capacity;
            $ticket->event_id = $event_id;
            $ticket->save();
        }
         return $event;
    }
}
?>
