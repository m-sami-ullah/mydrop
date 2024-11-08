<?php

namespace App\Services;

use App\Models\Nav; 
use App\Services\AppService;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;

class NavService extends AppService
{
    protected $model;

    public function __construct(Nav $model)
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
        $status = $request->status==1 ? 1:0;
        
         $data = array(
                        // 'sortorder'=>$request->sortorder, 
                        // 'name'=> $request->title,
                        // 'position'=> $request->position,
                        'title'=>$request->title,
                        'status'=>$status,
                    );
        return $data;
    }

    
    
    public function edit($nav,$request)
    {
        $this->update($nav,$request);
    }
     

}
