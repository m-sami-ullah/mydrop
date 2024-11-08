<?php

namespace App\Http\Controllers\api\settings;
use App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Services\PermissionService; 
use Exception;
use DB;

class PermissionController extends ApiController
{
    protected  $service;
    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $this->service->paginate($request);
        $records = $this->service->collection($records);
        return $this->success($records);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->authorize('create', Permission::class);
        try 
        {
            DB::beginTransaction();
            $this->service->store($request);
            DB::commit();
            return $this->success(null,$this->service->addMsg());
        } catch (\Exception $e) 
        {
            DB::rollback();
            return $this->error($e->getMessage(),400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $this->authorize('viewAny', Permission::class);
        $permission = $this->service->resource($permission);
        return $this->success($permission);
    }

     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        try 
        {
            $this->service->update($permission->id,$request);
            return $this->success(null,$this->service->updateMsg());
        } catch (Exception $e) 
        {
            return $this->error($e->getMessage(),400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);
        $this->service->delete($permission->id);
        return $this->success(null,$this->service->delMsg());
    }
}
