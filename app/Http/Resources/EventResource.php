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
            'id' => $this->id,
            'userId' => $this->user_id,
            'slug' => $this->slug,
            'title' => $this->title,
            'type' => $this->type,
            'status' => new EventStatusResource($this->status),
            'category' => new CategoryResource($this->category),
            'banner' => $this->banner,
            'description' => $this->description,
            'end_date' => $this->end_date,
            'end_time' => $this->end_time,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'venue' => $this->venue,
            'address' => $this->address,
            'lat' => $this->address_latitude,
            'lon' => $this->address_longitude,
            'ticket' => TicketResource::collection($this->ticket),
            'distance' => $this->distance,
        ];
    }
}
