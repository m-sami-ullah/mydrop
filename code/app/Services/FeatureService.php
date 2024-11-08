<?php

namespace App\Services;

use App\Models\Feature; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class FeatureService extends AppService
{
    protected $model;


    public function __construct(Feature $model)
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
			$id = $request->feature ? $request->feature->id : NULL;
            $available = $request->available ==1 ? 1:2;
			$payload = [
						"name"=> $request->name,
                        "available"=> $available,
						"package_id"=> $request->package->id,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
