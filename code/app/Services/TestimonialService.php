<?php

namespace App\Services;

use App\Models\Testimonial; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class TestimonialService extends AppService
{
    protected $model;
            protected $file_names;
            protected $directory = "testimonial";
            protected $files = ["image"];

    public function __construct(Testimonial $model)
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
            $id = $request->testimonial ? $request->testimonial->id : NULL;
            $payload = [
                        "name"=> $request->name,
                        "position"=> $request->position,
                        "description"=> $request->description,
                        "status"=> $request->status,
                        "image" => $this->file_names["image"],
            ];
            return $payload; 

    }
    
     
 
    
    
     

    
    

}
