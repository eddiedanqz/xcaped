<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'userId' => $this->user_id,
            'logo' => $this->logo,
            'type' => new TypeResource($this->type),
            'promotion' => PromotionResource::collection($this->promotions),
            'address' => $this->address,
            'address_latitude' => $this->address_latitude,
            'address_longitude' => $this->address_longitude,
            'start_day' => $this->start_day,
            'start_time' => $this->start_time,
            'close_day' => $this->close_day,
            'close_time' => $this->close_time,
            'phone' => $this->phone,
            'distance' => $this->distance,

        ];
    }
}
