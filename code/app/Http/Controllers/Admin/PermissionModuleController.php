<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionModuleRequest;
use Illuminate\Support\Facades\App;
use App\Models\PermissionModule;

use App\Services\PermissionModuleService;

use Exception;
use DB;
class PermissionModuleController extends WebController
{
    protected  $permissionmoduleservice;


    public function __construct(PermissionModuleService $permissionmoduleservice)
    {
        $this->permissionmoduleservice = $permissionmoduleservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', PermissionModule::class);
        
        $permissionmodules = $this->permissionmoduleservice->paginate($request);
        
        return view('admin.permissionmodules.index',['permissionmodules' => $permissionmodules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', PermissionModule::class);
        
        
        return view('admin.permissionmodules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionModuleRequest $request)
    {
        $this->authorize('create',PermissionModule::class);
        try {
            DB::beginTransaction();
            $record = $this->permissionmoduleservice->store($request);
            $this->success($this->permissionmoduleservice->addMsg());
            DB::commit();
            return redirect()->route('permissionmodules.index');
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
    public function show(PermissionModule $permissionmodule)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,PermissionModule $permissionmodule)
    {
        $this->authorize('update', $permissionmodule);
        
        
        return view('admin.permissionmodules.edit',['permissionmodule' => $permissionmodule]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionModuleRequest $request, PermissionModule $permissionmodule)
    {
        $this->authorize('create',PermissionModule::class);
        try {
            DB::beginTransaction();
            $record = $this->permissionmoduleservice->update($permissionmodule,$request);
            $this->success($this->permissionmoduleservice->updateMsg());
            DB::commit();
            return redirect()->route('permissionmodules.index');
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
    public function destroy(PermissionModule $permissionmodule)
    {   
        $this->authorize('delete',PermissionModule::class);  
        try {
            DB::beginTransaction();
            $this->permissionmoduleservice->delete($permissionmodule);
            $this->success($this->permissionmoduleservice->delMsg());
            DB::commit();
            return redirect()->route('permissionmodules.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', PermissionModule::class);
        try {
            DB::beginTransaction();
            $this->permissionmoduleservice->deleteall($request);
            $this->success($this->permissionmoduleservice->delMsg());
            DB::commit();
            return redirect()->route('permissionmodules.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->permissionmoduleservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
