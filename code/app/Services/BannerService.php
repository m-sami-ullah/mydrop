<?php

namespace App\Services;

use App\Models\Banner; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class BannerService extends AppService
{
    protected $model;
			protected $file_names;
			protected $directory = "banner";
			protected $files = ["image"];

    public function __construct(Banner $model)
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
			$id = $request->banner ? $request->banner->id : NULL;
			$payload = [
						"name"=> $request->name,
						"btntitle"=> $request->btntitle,
						"description"=> $request->description,
						"status"=> $request->status,
						"image" => $this->file_names["image"],
						"link"=> $request->link,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
