<?php

namespace App\Services;

use App\Models\Group; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class GroupService extends AppService
{
    protected $model;


    public function __construct(Group $model)
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
			$id = $request->group ? $request->group->id : NULL;
			$payload = [
						"name"=> $request->name,
						"status"=> $request->status,
			];
			return $payload; 

    }
    
     
			public function save($request)
			{
				 $group = $this->store($request);
				 $group->group_permission()->sync($request->permission_id);
			}

			public function edit($group,$request)
			{
				$this->update($group,$request);
				$group->group_permission()->sync($request->permission_id);
			}
 
    
    
     

    
    

}
