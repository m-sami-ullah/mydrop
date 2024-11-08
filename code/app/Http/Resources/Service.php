<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
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
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,
			"short" => $this->short,
			"description" => $this->description,
			"slug" => $this->slug,
			"image" => $this->image,
			"status" => $this->status,

        ];
    }
}
