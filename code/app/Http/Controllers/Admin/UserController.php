<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\App;
use App\Models\User;

use App\Services\UserService;
use App\Services\GroupService;

use Exception;
use DB;
class UserController extends WebController
{
    protected  $userservice;
protected  $groupservice;


    public function __construct(UserService $userservice,GroupService $groupservice)
    {
        $this->userservice = $userservice;
$this->groupservice = $groupservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        
        $users = $this->userservice->paginate($request);
        
        return view('admin.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);
        
        		$groups = $this->groupservice->get($request);
		$group_user = $this->groupservice->dropdown($groups,old('group_id'),['id','name']);
		$constactivatedoptions = $this->userservice->getconst("ACTIVATED_SELECT");
		$constactivatedoptions = $this->userservice->dropdown($constactivatedoptions,old('activated'));

        return view('admin.users.create',['group_useroptions' => $group_user,'constactivatedoptions' => $constactivatedoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create',User::class);
        try {
            DB::beginTransaction();
            $record = $this->userservice->save($request);
            $this->success($this->userservice->addMsg());
            DB::commit();
            return redirect()->route('users.index');
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
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,User $user)
    {
        $this->authorize('update', $user);
        
        		$groups = $this->groupservice->get($request);
		$group_user = $this->groupservice->dropdown($groups,$user->group_user,['id','name']);
		$constactivatedoptions = $this->userservice->getconst("ACTIVATED_SELECT");
		$constactivatedoptions = $this->userservice->dropdown($constactivatedoptions,$user->activated);

        return view('admin.users.edit',['user' => $user,'group_useroptions' => $group_user,'constactivatedoptions' => $constactivatedoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('create',User::class);
        try {
            DB::beginTransaction();
            $record = $this->userservice->edit($user,$request);
            $this->success($this->userservice->updateMsg());
            DB::commit();
            return redirect()->route('users.index');
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
    public function destroy(User $user)
    {   
        $this->authorize('delete',User::class);  
        try {
            DB::beginTransaction();
            $this->userservice->delete($user);
            $this->success($this->userservice->delMsg());
            DB::commit();
            return redirect()->route('users.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', User::class);
        try {
            DB::beginTransaction();
            $this->userservice->deleteall($request);
            $this->success($this->userservice->delMsg());
            DB::commit();
            return redirect()->route('users.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->userservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
