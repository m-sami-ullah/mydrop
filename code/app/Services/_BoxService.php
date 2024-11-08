<?php

namespace App\Services;

use App\Models\Box; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class BoxService extends AppService
{
    protected $model;
			// protected $file_names;
			// protected $directory = "box";
			// protected $files = ["image"];

    public function __construct(Box $model)
    {
        parent::__construct($model);
        $this->model = $model;
			// $this->file_names["image"]="";

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->box ? $request->box->id : NULL;
			$payload = [
						"customer_id"=> $request->customer->id,
						"address_id"=> $request->address->id,
                        "switch_id"=> $request->switch_id,
                        "camera_id"=> $request->camera_id,
                        "status"=> $request->status,
						/*"package_id"=> $request->package_id,
                        "package"=> $request->package,
                        "price"=> $request->price,
                        "total"=> $request->total,
                        "tax"=> $request->tax,
                        "payment_type"=> $request->payment_type,
                        "invoice_number"=> $request->invoice_number,
                        "invoicestatus_id"=> $request->invoice_status,*/
						// "orderstatus_id"=> $request->status,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
