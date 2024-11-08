<?php

namespace App\Services;

use App\Models\Social; 
use App\Services\AppService;
use Illuminate\Http\Request; 
class SocialService extends AppService
{
    protected $model;

    public function __construct(Social $model)
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
        $status = $request->status==1?1:0;
         $data =  [
            'icon'=>$request->icon,
            'link'=>$request->link,
            'status'=>$status,
            ];
         
        return $data;
    }

     
    
        

}
