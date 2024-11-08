<?php

namespace App\Http\Resources;

use App\Http\Resources\Address as AddressResource;
use App\Models\Box as Boxs;
use Illuminate\Http\Resources\Json\JsonResource;

class Box extends JsonResource
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
            "boxnumber" => $this->boxnumber,
			"created_at" => $this->created_at,
			"updated_at" => $this->updated_at,
			// "qrcode" => $this->qrcode,
			// "boxtype" => $this->boxtype,
            "boxtype" => $this->boxtype ? Boxs::BOXTYPE_SELECT[$this->boxtype]:'',
            "status" => $this->status ? Boxs::STATUS_SELECT[$this->status]:'',
			// "status" => $this->status,
			// "customer_id" => $this->customer_id,
			"address" => $this->address ? AddressResource::make($this->address):[],

        ];
    }
}
