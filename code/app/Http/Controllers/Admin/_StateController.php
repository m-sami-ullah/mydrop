<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\StateRequest;
use Illuminate\Support\Facades\App;
use App\Models\State;

use App\Services\StateService;

use Exception;
use DB;
class _StateController extends WebController
{
    protected  $stateservice;


    public function __construct(StateService $stateservice)
    {
        $this->stateservice = $stateservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', State::class);
        
        $states = $this->stateservice->paginate($request);
        
        return view('admin.states.index',['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', State::class);
        
        
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $this->authorize('create',State::class);
        try {
            DB::beginTransaction();
            $record = $this->stateservice->store($request);
            $this->success($this->stateservice->addMsg());
            DB::commit();
            return redirect()->route('states.index');
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
    public function show(State $state)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,State $state)
    {
        $this->authorize('update', $state);
        
        
        return view('admin.states.edit',['state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $this->authorize('create',State::class);
        try {
            DB::beginTransaction();
            $record = $this->stateservice->update($state,$request);
            $this->success($this->stateservice->updateMsg());
            DB::commit();
            return redirect()->route('states.index');
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
    public function destroy(State $state)
    {   
        $this->authorize('delete',State::class);  
        try {
            DB::beginTransaction();
            $this->stateservice->delete($state);
            $this->success($this->stateservice->delMsg());
            DB::commit();
            return redirect()->route('states.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', State::class);
        try {
            DB::beginTransaction();
            $this->stateservice->deleteall($request);
            $this->success($this->stateservice->delMsg());
            DB::commit();
            return redirect()->route('states.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->stateservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
