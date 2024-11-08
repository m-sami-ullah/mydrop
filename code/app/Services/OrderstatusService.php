<?php

namespace App\Services;

use App\Models\Orderstatus; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class OrderstatusService extends AppService
{
    protected $model;


    public function __construct(Orderstatus $model)
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
			$id = $request->orderstatus ? $request->orderstatus->id : NULL;
			$payload = [
						"name"=> $request->name,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
