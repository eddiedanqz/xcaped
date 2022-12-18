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
            "category"=> new CategoryResource($this->category),
            "author" => $this->author,
            "banner"=>$this->banner,
            "description" => $this->description,
            "end_date" =>$this->end_date,
            "end_time" =>$this->end_time,
            "start_date" => $this->start_date,
            "start_time" => $this->start_time,
            "venue" => $this->venue,
            "address" => $this->address,
            "ticket" => TicketResource::collection($this->ticket),
            "distance" => $this->distance
        ];
    }
}
