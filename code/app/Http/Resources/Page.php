<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
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
			"description" => $this->description,
			"image" => $this->image,
			"meta_title" => $this->meta_title,
			"keywords" => $this->keywords,
			"meta_description" => $this->meta_description,
			"robots" => $this->robots,
			"status" => $this->status,

        ];
    }
}
