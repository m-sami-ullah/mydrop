<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Group_permission extends JsonResource
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
			"group_id" => $this->group_id,
			"permission_id" => $this->permission_id,
			"status" => $this->status,

        ];
    }
}
