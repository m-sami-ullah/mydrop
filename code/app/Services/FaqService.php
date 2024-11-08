<?php

namespace App\Services;

use App\Models\Faq; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class FaqService extends AppService
{
    protected $model;


    public function __construct(Faq $model)
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
			$id = $request->faq ? $request->faq->id : NULL;
			$payload = [
						"question"=> $request->question,
						"answer"=> $request->answer,
						"status"=> $request->status,
			];
			return $payload; 

    }
    
     
 
    
    
     

    
    

}
