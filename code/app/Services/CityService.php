<?php

namespace App\Services;

use App\Models\City; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class CityService extends AppService
{
    protected $model;


    public function __construct(City $model)
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
			$id = $request->city ? $request->city->id : NULL;
			$payload = [
						"name"=> $request->name,
						"state_id"=> $request->state_id,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
