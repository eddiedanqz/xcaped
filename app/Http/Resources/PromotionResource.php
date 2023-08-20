<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            //'placeId' => $this->place_id,
            'special' => new SpecialResource($this->special),
            'details' => $this->details,
            'type' => $this->type,
            'date' => $this->date,
        ];
    }
}
