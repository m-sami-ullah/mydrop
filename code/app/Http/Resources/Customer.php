<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
			"firstname" => $this->firstname,
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,
			"lastname" => $this->lastname,
			"email" => $this->email,
			"password" => $this->password,
			"phone" => $this->phone,
			"status" => $this->status,
			"lastlogin" => $this->lastlogin,
			"ip" => $this->ip,
			"signup" => $this->signup,

        ];
    }
}
