<?php

namespace App\Services;

use App\Models\Country; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class CountryService extends AppService
{
    protected $model;


    public function __construct(Country $model)
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
			$id = $request->country ? $request->country->id : NULL;
			$payload = [
						"name"=> $request->name,
						"iso"=> $request->iso,
						"nicename"=> $request->nicename,
						"iso3"=> $request->iso3,
						"numcode"=> $request->numcode,
						"phonecode"=> $request->phonecode,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
