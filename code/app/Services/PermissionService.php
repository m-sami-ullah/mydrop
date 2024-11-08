<?php

namespace App\Services;

use App\Models\Permission; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class PermissionService extends AppService
{
    protected $model;


    public function __construct(Permission $model)
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
			$id = $request->permission ? $request->permission->id : NULL;
			$payload = [
						"name"=> $request->name,
						"function"=> $request->function,
						"module_id"=> $request->module_id,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
