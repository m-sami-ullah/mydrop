<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\PermissionModule;
use App\Services\GroupService;
use App\Services\PermissionService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class GroupController extends WebController
{
    protected  $groupservice;
protected  $permissionservice;


    public function __construct(GroupService $groupservice,PermissionService $permissionservice)
    {
        $this->groupservice = $groupservice;
$this->permissionservice = $permissionservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Group::class);
        
        $groups = $this->groupservice->paginate($request);
        
        return view('admin.groups.index',['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Group::class);
        
        		// $permissions = $this->permissionservice->get($request);
		// $group_permission = $this->permissionservice->dropdown($permissions,old('permission_id'),['id','name']);
		$conststatusoptions = $this->groupservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->groupservice->dropdown($conststatusoptions,old('status'));
        $permissionModule = PermissionModule::with('permissions')->get();

        return view('admin.groups.create',['permissionModule' => $permissionModule,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $this->authorize('create',Group::class);
        try {
            DB::beginTransaction();
            $record = $this->groupservice->save($request);
            $this->success($this->groupservice->addMsg());
            DB::commit();
            return redirect()->route('groups.index');
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
    public function show(Group $group)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Group $group)
    {
        $this->authorize('update', $group);
        
        $permissionModule = PermissionModule::with('permissions')->get();
        
		$conststatusoptions = $this->groupservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->groupservice->dropdown($conststatusoptions,$group->status);

        return view('admin.groups.edit',['group' => $group,'permissionModule' => $permissionModule,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $this->authorize('create',Group::class);
        try {
            DB::beginTransaction();
            $record = $this->groupservice->edit($group,$request);
            $this->success($this->groupservice->updateMsg());
            DB::commit();
            return redirect()->route('groups.index');
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
    public function destroy(Group $group)
    {   
        $this->authorize('delete',Group::class);  
        try {
            DB::beginTransaction();
            $this->groupservice->delete($group);
            $this->success($this->groupservice->delMsg());
            DB::commit();
            return redirect()->route('groups.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Group::class);
        try {
            DB::beginTransaction();
            $this->groupservice->deleteall($request);
            $this->success($this->groupservice->delMsg());
            DB::commit();
            return redirect()->route('groups.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->groupservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
