<?php

namespace App\Http\Resources;

use App\Models\Device as Devicetable;
use Illuminate\Http\Resources\Json\JsonResource;

class Device extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $doortoggle = ''; 
        if ($this->boxtype==1) 
        {
            $doortoggle = $this->ip . '::' . $this->port;            
        }
        return 
        [   
			"id" => $this->id,
			"name" => $this->name,
             "fccid" => $this->deviceid, 
             "type" => $this->boxtype ? Devicetable::TYPE_SELECT[$this->boxtype]:'', 
             "model" => $this->model, 
             "port" => $this->port, 
             "installdate" => $this->installdate, 
             "status" => $this->status ? Devicetable::STATUS_SELECT[$this->status]:'', 
             'doortoggle' => $doortoggle,

         "images" => $this->images ? Image::collection($this->images):[],

        ];
    }
}
