<?php

namespace App\Services;

use App\Models\Boxdevice; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class BoxdeviceService extends AppService
{
    protected $model;


    public function __construct(Boxdevice $model)
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
			$id = $request->boxdevice ? $request->boxdevice->id : NULL;
			$payload = [
						"box_id"=> $request->box->id,
						"device_id"=> $request->device_id,
						"status"=> $request->status,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
