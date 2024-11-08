<?php

namespace App\Services;

use App\Models\User; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class UserService extends AppService
{
    protected $model;


    public function __construct(User $model)
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
			$id = $request->user ? $request->user->id : NULL;
			$payload = [
						"name"=> $request->name,
						"email"=> $request->email,
						"activated"=> $request->activated,
			];
			 if (!$id) 
			{ 
						$payload["password"] = bcrypt($request->password);
			} 
			return $payload; 

    }
    
     
			public function save($request)
			{
			 $user = $this->store($request);
			 $user->group_user()->sync($request->group_id);
			}

			public function edit($user,$request)
			{
			$this->update($user,$request);
			$user->group_user()->sync($request->group_id);
			}
 
    
    
     

    
    

}
