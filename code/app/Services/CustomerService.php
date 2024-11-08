<?php

namespace App\Services;

use App\Models\Customer; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class CustomerService extends AppService
{
    protected $model;


    public function __construct(Customer $model)
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
			$id = $request->customer ? $request->customer->id : NULL;
			$payload = [
						"firstname"=> $request->firstname,
						"lastname"=> $request->lastname,
						"email"=> $request->email,
						"phone"=> $request->phone,
						"status"=> $request->status,
						"lastlogin"=> $request->lastlogin,
						"ip"=> $request->ip,
						"signup"=> $request->signup,
			];
			 if (!$id) 
			{ 
						$payload["password"] = bcrypt($request->password);
			} 
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
