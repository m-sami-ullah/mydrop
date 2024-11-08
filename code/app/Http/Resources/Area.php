<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Area extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [   
			"id" => $this->id,
			"name" => $this->name,
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,
			"city_id" => $this->city_id,
			"state_id" => $this->state_id,

        ];
    }
}
