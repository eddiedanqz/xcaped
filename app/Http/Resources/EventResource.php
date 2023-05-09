<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            "slug" =>$this->slug,
            "title" => $this->title,
<<<<<<< HEAD
            "type" => $this->type,
            "userId" => $this->user_id,
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
            "category"=> new CategoryResource($this->category),
            "author" => $this->author,
            "banner"=>$this->banner,
            "description" => $this->description,
            "end_date" =>$this->end_date,
            "end_time" =>$this->end_time,
            "start_date" => $this->start_date,
            "start_time" => $this->start_time,
            "venue" => $this->venue,
<<<<<<< HEAD
            "address" => $this->address,
            "lat" => $this->address_latitude,
            "lon" => $this->address_longitude,
            "ticket" => TicketResource::collection($this->ticket),
            "distance" => $this->distance
=======
            "ticket" => TicketResource::collection($this->ticket),
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
        ];
    }
}
