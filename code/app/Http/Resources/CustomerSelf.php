<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerSelf extends JsonResource
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
            'id' => (int)$this->id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            'email' => $this->email ? $this->email:'',
            // "email" => $this->email,
            // 'name' => $this->name,
            // 'phone' => $this->phone ? $this->phone:'',
            'code' => $this->code ? $this->code:'',
            // 'about' => $this->about ? $this->about:'',
            // 'gender' => $this->gender ? $this->gender->name:'',
            // 'gender_id' => $this->gender_id,
            // 'dob' => $this->dob?  date('Y-m-d',strtotime($this->dob)):'',
            // 'showphone' => $this->showphone ? true:false,
            'blocked' =>  $this->blocked ? true:false,
            'activated' =>  $this->activated ? true:false,
            // 'city' => $this->city? $this->city->name : '',
            // 'cityid' => $this->city_id ? (int) $this->city_id:0,
            // 'area' => $this->area? $this->area->name : '',
            // 'areaid' => $this->area_id ? (int)  $this->area_id:0,
            // 'stateparentattribute_id' => NULL,
            // 'cityparentattribute_id' =>(int) 1,
            // 'areaparentattribute_id' => (int)2,
            
            // 'cityparent_id' => $this->city? (int)$this->city->state_id : 0,
            // 'areaparent_id' => $this->area? (int)$this->area->city_id : 0,
            
            // 'state' => $this->state? $this->state->name : '',
            // 'stateid' => $this->state_id ? (int) $this->state_id:0,
            'email_verified' => $this->email_verified_at ? $this->email_verified_at:'',
            // 'phone_verified' => $this->phone_verified_at ? $this->phone_verified_at:'',
            // 'verified' => $this->verifyIcon('m-'),
            // 'profileID' => $this->profile ? $this->profile:'',
            'avatar' => $this->getAvatar(),
            'member_since' => $this->created_at ? $this->created_at->toDateTimeString():'',
            // 'ads' =>  $this->advertises()->count(),
        ];
    }
}
