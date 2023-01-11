<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "order_id" =>$this->order_id,
            "event_id" => $this->event_id,
            "ticket_id" => $this->ticket_id,
            "fullname"=>$this->fullname,
            // "email" => $this->email,
            "reference" =>$this->reference,
            "checkIn_time" =>$this->check_time,
            "status" =>$this->status,
            "ticket" => new TicketResource($this->ticket),
            "event" => new EventResource($this->event),
        ];
    }
}
