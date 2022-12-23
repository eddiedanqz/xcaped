<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "eventId" =>$this->event_id,
            "title" =>$this->title,
            "price" =>$this->price,
            "capacity" =>$this->capacity,
            "available_from" =>$this->available_from,
            "available_to" =>$this->available_to,
        ];
    }
}
