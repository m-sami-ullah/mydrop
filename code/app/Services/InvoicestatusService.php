<?php

namespace App\Services;

use App\Models\Invoicestatus; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class InvoicestatusService extends AppService
{
    protected $model;


    public function __construct(Invoicestatus $model)
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
			$id = $request->invoicestatus ? $request->invoicestatus->id : NULL;
			$payload = [
						"name"=> $request->name,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
