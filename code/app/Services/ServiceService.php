<?php

namespace App\Services;

use App\Models\Service; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class ServiceService extends AppService
{
    protected $model;
			protected $file_names;
			protected $directory = "service";
			protected $files = ["image","banner"];

    public function __construct(Service $model)
    {
        parent::__construct($model);
        $this->model = $model;
			$this->file_names["image"]="";
            $this->file_names["banner"]="";

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->service ? $request->service->id : NULL;
			$payload = [
						"title"=> $request->title,
						"short"=> $request->short,
						"description"=> $request->description,
						"slug"=> $request->slug,
						"image" => $this->file_names["image"],
                        "banner" => $this->file_names["banner"],
						"status"=> $request->status,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
