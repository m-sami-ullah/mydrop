<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Group extends JsonResource
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
			"status" => $this->status,
			"permission_id" => $this->permission_id,
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,

        ];
    }
}
