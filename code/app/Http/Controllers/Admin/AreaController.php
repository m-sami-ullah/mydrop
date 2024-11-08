<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\AreaRequest;
use Illuminate\Support\Facades\App;
use App\Models\Area;

use App\Services\AreaService;
use App\Services\CityService;
use App\Services\StateService;

use Exception;
use DB;
class AreaController extends WebController
{
    protected  $areaservice;
protected  $cityservice;
protected  $stateservice;


    public function __construct(AreaService $areaservice,CityService $cityservice,StateService $stateservice)
    {
        $this->areaservice = $areaservice;
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
        $this->authorize('viewAny', Area::class);
        
        $areas = $this->areaservice->paginate($request);
        
        return view('admin.areas.index',['areas' => $areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Area::class);
        
        		$cities = $this->cityservice->get($request);
		$citiesoptions = $this->cityservice->dropdown($cities,old('city_id'),['id','name']);
		$states = $this->stateservice->get($request);
		$statesoptions = $this->stateservice->dropdown($states,old('state_id'),['id','name']);

        return view('admin.areas.create',['cityoptions' => $citiesoptions,'stateoptions' => $statesoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $this->authorize('create',Area::class);
        try {
            DB::beginTransaction();
            $record = $this->areaservice->store($request);
            $this->success($this->areaservice->addMsg());
            DB::commit();
            return redirect()->route('areas.index');
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
    public function show(Area $area)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Area $area)
    {
        $this->authorize('update', $area);
        
        		$cities = $this->cityservice->get($request);
		$citiesoptions = $this->cityservice->dropdown($cities,$area->city_id,['id','name']);
		$states = $this->stateservice->get($request);
		$statesoptions = $this->stateservice->dropdown($states,$area->state_id,['id','name']);

        return view('admin.areas.edit',['area' => $area,'cityoptions' => $citiesoptions,'stateoptions' => $statesoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, Area $area)
    {
        $this->authorize('create',Area::class);
        try {
            DB::beginTransaction();
            $record = $this->areaservice->update($area,$request);
            $this->success($this->areaservice->updateMsg());
            DB::commit();
            return redirect()->route('areas.index');
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
    public function destroy(Area $area)
    {   
        $this->authorize('delete',Area::class);  
        try {
            DB::beginTransaction();
            $this->areaservice->delete($area);
            $this->success($this->areaservice->delMsg());
            DB::commit();
            return redirect()->route('areas.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Area::class);
        try {
            DB::beginTransaction();
            $this->areaservice->deleteall($request);
            $this->success($this->areaservice->delMsg());
            DB::commit();
            return redirect()->route('areas.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->areaservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
