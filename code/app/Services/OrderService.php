<?php

namespace App\Services;

use App\Models\Order; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class OrderService extends AppService
{
    protected $model;
			protected $file_names;
			protected $directory = "order";
			protected $files = ["image"];

    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
			$this->file_names["image"]="";

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->order ? $request->order->id : NULL;
			$payload = [
						"customer_id"=> $request->customer_id,
						"address_id"=> $request->address_id,
						"package_id"=> $request->package_id,
                        "package"=> $request->package,
                        "price"=> $request->price,
                        "total"=> $request->total,
                        "tax"=> $request->tax,
                        "payment_type"=> $request->payment_type,
                        "invoice_number"=> $request->invoice_number,
                        "invoicestatus_id"=> $request->invoice_status,
						"orderstatus_id"=> $request->status,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
