<?php

namespace App\Services;

use App\Models\Address; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class AddressService extends AppService
{
    protected $model;


    public function __construct(Address $model)
    {
        parent::__construct($model);
        $this->model = $model;

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->address ? $request->address->id : NULL;
			$payload = [
						"title"=> $request->title,
						"state_id"=> $request->state_id,
						"city_id"=> $request->city_id,
						"area_id"=> $request->area_id,
						"postcode"=> $request->postcode,
						"saddress"=> $request->streetaddress,
						"customer_id"=> $request->customer->id,
			];
			return $payload; 

    }
    
     
 
    
    /*public function add_new($request)
    {
        $data = $this->setDataPayload($request);
        $data['customer_id'] = Auth::guard('customer')->user()->id;
        $this->model->create($data);
    }*/
     

    
    

}
