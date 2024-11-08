<?php

namespace App\Services;

use App\Models\Client; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class ClientService extends AppService
{
    protected $model;
			protected $file_names;
			protected $directory = "client";
			protected $files = ["logo"];

    public function __construct(Client $model)
    {
        parent::__construct($model);
        $this->model = $model;
			$this->file_names["logo"]="";

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->client ? $request->client->id : NULL;
			$payload = [
						"name"=> $request->name,
						"logo" => $this->file_names["logo"],
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
