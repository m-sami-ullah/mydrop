<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use Illuminate\Support\Facades\App;
use App\Models\Permission;

use App\Services\PermissionService;
use App\Services\PermissionmoduleService;

use Exception;
use DB;
class PermissionController extends WebController
{
    protected  $permissionservice;
protected  $permissionmoduleservice;


    public function __construct(PermissionService $permissionservice,PermissionmoduleService $permissionmoduleservice)
    {
        $this->permissionservice = $permissionservice;
$this->permissionmoduleservice = $permissionmoduleservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);
        
        $permissions = $this->permissionservice->paginate($request);
        
        return view('admin.permissions.index',['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Permission::class);
        
        		$permissionmodules = $this->permissionmoduleservice->get($request);
		$permissionmodulesoptions = $this->permissionmoduleservice->dropdown($permissionmodules,old('module_id'),['id','name']);

        return view('admin.permissions.create',['permissionmoduleoptions' => $permissionmodulesoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->authorize('create',Permission::class);
        try {
            DB::beginTransaction();
            $record = $this->permissionservice->store($request);
            $this->success($this->permissionservice->addMsg());
            DB::commit();
            return redirect()->route('permissions.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Permission $permission)
    {
        $this->authorize('update', $permission);
        
        		$permissionmodules = $this->permissionmoduleservice->get($request);
		$permissionmodulesoptions = $this->permissionmoduleservice->dropdown($permissionmodules,$permission->module_id,['id','name']);

        return view('admin.permissions.edit',['permission' => $permission,'permissionmoduleoptions' => $permissionmodulesoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $this->authorize('create',Permission::class);
        try {
            DB::beginTransaction();
            $record = $this->permissionservice->update($permission,$request);
            $this->success($this->permissionservice->updateMsg());
            DB::commit();
            return redirect()->route('permissions.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
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
        $this->authorize('delete',Permission::class);  
        try {
            DB::beginTransaction();
            $this->permissionservice->delete($permission);
            $this->success($this->permissionservice->delMsg());
            DB::commit();
            return redirect()->route('permissions.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Permission::class);
        try {
            DB::beginTransaction();
            $this->permissionservice->deleteall($request);
            $this->success($this->permissionservice->delMsg());
            DB::commit();
            return redirect()->route('permissions.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->permissionservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
