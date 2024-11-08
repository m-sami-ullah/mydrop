<?php

namespace App\Http\Resources\collection;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TestimonialCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = 'App\Http\Resources\Testimonial';
    
    public function toArray($request)
    {
       return $this->resource;
    }
}
