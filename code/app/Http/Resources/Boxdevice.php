<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Boxdevice extends JsonResource
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
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,
			"box_id" => $this->box_id,
			"device_id" => $this->device_id,
			"status" => $this->status,

        ];
    }
}
