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
<<<<<<< HEAD
            "eventId" =>$this->event_id,
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
            "title" =>$this->title,
            "price" =>$this->price,
            "capacity" =>$this->capacity,
            "available_from" =>$this->available_from,
            "available_to" =>$this->available_to,
        ];
    }
}
