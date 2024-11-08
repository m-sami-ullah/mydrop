<?php

namespace App\Http\Resources\collection;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Group_permissionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = 'App\Http\Resources\Group_permission';
    
    public function toArray($request)
    {
       return $this->resource;
    }
}
