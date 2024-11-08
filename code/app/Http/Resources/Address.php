<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
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
			"title" => $this->title,
			"state" => $this->state ? $this->state->name :'',
			"city" => $this->city ? $this->city->name :'',
			"area" => $this->area ? $this->area->name :'',
			"postcode" => $this->postcode,
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,
			// "address" => $this->address,
			// "customer" => $this->customer,

        ];
    }
}
