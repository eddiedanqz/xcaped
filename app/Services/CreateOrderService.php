<?php
namespace App\Services;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\Attendee;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CreateOrderService {

    public function create($request)
    {
        $user = auth()->user();

        $total = 0;
        $quantity = 0;
        $eventId;

        $data = json_decode($request->tickets);
        // $data = [$request->all()];

        $order = new Order();
        $order->order_no = 'XCP'.rand(11111111,99999999);
        $order->user_id = $user->id;
        $order->full_name = $user->fullname;
        $order->user_email = $user->email;
        //Calculate total price
        foreach ($data as $ticket)
        {
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
        foreach ($data as $item)
        {
         $order->items()->attach($item->ticketId,
            [
                'price' => $item->price,
                'quantity'=> $item->qty
            ]);
            //Check stock
            $ticket = Ticket::find($item->ticketId);
            $ticket->capacity = $ticket->capacity - $item->qty;
            $ticket->update();
        }

        /**refactor */
        foreach ($data as $item) {
            for ($i=0; $i < $item->qty; $i++) {
                $attendee = new Attendee;
                $attendee->order_id = $order->id;
                $attendee->event_id = $eventId;
                $attendee->user_id = $user->id;
                $attendee->ticket_id = $item->ticketId;
                $attendee->fullname = $user->fullname;
                $attendee->email = $user->email;
                $attendee->reference = rand(11111111,99999999);
                $attendee->save();
            }
        }

        //Send notification
        Notification::send($user, new OrderCreated($order));

        // $attendees = Attendee::where('order_id',$order->id)->get();
        //   foreach ($attendees as $attendee) {
        //     // $image = QrCode::format('png')
        //     //     //  ->merge('img/t.jpg', 0.1, true)
        //     //      ->size(200)->errorCorrection('H')
        //     //      ->generate('A simple example of QR code!');
        //     //         $output_file = '/images/qr-code/img-' . time() . '.png';
        //     //         \Storage::disk('public')->put($output_file, $image);
        //     Mail::to($attendee->email)->send(new GenerateQrCodeMail($attendee));
        //   }
        //
    }

    public function createAtendee()
    {
         foreach ($data as $item) {
                $attendee = new Attendee;
                $attendee->order_id = $order->id;
                $attendee->event_id = $eventId;
                $attendee->ticket_id = $item->ticketId;
                $attendee->fullname = $user->fullname;
                $attendee->email = $user->email;
                $attendee->reference = rand(11111111,99999999);
                $attendee->save();
                $item->qty -= 1;
            if ($item->qty > 0) {
                createAtendee();
            }
        }
    }
}
?>
