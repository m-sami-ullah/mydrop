<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\App;
use App\Models\City;

use App\Services\CityService;
use App\Services\StateService;

use Exception;
use DB;
class CityController extends WebController
{
    protected  $cityservice;
protected  $stateservice;


    public function __construct(CityService $cityservice,StateService $stateservice)
    {
        $this->cityservice = $cityservice;
$this->stateservice = $stateservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', City::class);
        
        $cities = $this->cityservice->paginate($request);
        
        return view('admin.cities.index',['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', City::class);
        
        		$states = $this->stateservice->get($request);
		$statesoptions = $this->stateservice->dropdown($states,old('state_id'),['id','name']);

        return view('admin.cities.create',['stateoptions' => $statesoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $this->authorize('create',City::class);
        try {
            DB::beginTransaction();
            $record = $this->cityservice->store($request);
            $this->success($this->cityservice->addMsg());
            DB::commit();
            return redirect()->route('cities.index');
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
    public function show(City $city)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,City $city)
    {
        $this->authorize('update', $city);
        
        		$states = $this->stateservice->get($request);
		$statesoptions = $this->stateservice->dropdown($states,$city->state_id,['id','name']);

        return view('admin.cities.edit',['city' => $city,'stateoptions' => $statesoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $this->authorize('create',City::class);
        try {
            DB::beginTransaction();
            $record = $this->cityservice->update($city,$request);
            $this->success($this->cityservice->updateMsg());
            DB::commit();
            return redirect()->route('cities.index');
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
    public function destroy(City $city)
    {   
        $this->authorize('delete',City::class);  
        try {
            DB::beginTransaction();
            $this->cityservice->delete($city);
            $this->success($this->cityservice->delMsg());
            DB::commit();
            return redirect()->route('cities.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', City::class);
        try {
            DB::beginTransaction();
            $this->cityservice->deleteall($request);
            $this->success($this->cityservice->delMsg());
            DB::commit();
            return redirect()->route('cities.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->cityservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
