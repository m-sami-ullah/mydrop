<?php

namespace App\Services;

use App\Models\State; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class StateService extends AppService
{
    protected $model;


    public function __construct(State $model)
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
			$id = $request->state ? $request->state->id : NULL;
			$payload = [
						"name"=> $request->name,
                        "country_id"=> $request->country_id,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
