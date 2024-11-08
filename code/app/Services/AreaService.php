<?php

namespace App\Services;

use App\Models\Area; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class AreaService extends AppService
{
    protected $model;


    public function __construct(Area $model)
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
			$id = $request->area ? $request->area->id : NULL;
			$payload = [
						"name"=> $request->name,
						"city_id"=> $request->city_id,
						"state_id"=> $request->state_id,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
