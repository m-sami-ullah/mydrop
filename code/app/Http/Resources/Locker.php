<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Locker extends JsonResource
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
			"deviceid" => $this->deviceid,
			"ip" => $this->ip,
			"model" => $this->model,
			"install" => $this->install,
			"channels" => $this->channels,
			"status" => $this->status,
			"installed" => $this->installed,

        ];
    }
}
