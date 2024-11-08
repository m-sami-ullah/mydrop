<?php

namespace App\Services;

use App\Models\PermissionModule; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class PermissionModuleService extends AppService
{
    protected $model;


    public function __construct(PermissionModule $model)
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
			$id = $request->permissionmodule ? $request->permissionmodule->id : NULL;
			$payload = [
						"name"=> $request->name,
						"key"=> $request->key,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
