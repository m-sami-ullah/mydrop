<?php

namespace App\Services;

use App\Models\Package;
use App\Services\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class PackageService extends AppService
{
    protected $model;


    public function __construct(Package $model)
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
			$id = $request->package ? $request->package->id : NULL;
			$payload = [
						"name"=> $request->name,
                        "slug"=> Str::slug($request->slug),
						"description"=> $request->description,
						"price"=> $request->price,
						"duration"=> $request->duration,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
