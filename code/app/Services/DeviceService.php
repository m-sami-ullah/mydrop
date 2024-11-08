<?php

namespace App\Services;

use App\Models\Device; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class DeviceService extends AppService
{
    protected $model;


    public function __construct(Device $model)
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
			$id = $request->device ? $request->device->id : NULL;
			$payload = [
						"name"=> $request->name,
						"deviceid"=> $request->deviceid,
						"boxtype"=> $request->type,
						"model"=> $request->model,
						"port"=> $request->port,
						// "install"=> $request->install,
						// "channels"=> $request->channels,
                        // "status"=> $request->status,
						// "installed"=> $request->installed,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
