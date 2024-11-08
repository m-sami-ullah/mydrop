<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\DeviceRequest;
use Illuminate\Support\Facades\App;
use App\Models\Device;

use App\Services\DeviceService;

use Exception;
use DB;
class DeviceController extends WebController
{
    protected  $service;


    public function __construct(DeviceService $service)
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
        $this->authorize('viewAny', Device::class);
        
        $devices = $this->service->all($request);
        
        return view('admin.devices.index',['devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Device::class);
        
        		$consttypeoptions = $this->service->getconst("TYPE_SELECT");
		$consttypeoptions = $this->service->dropdown($consttypeoptions,old('type'));

        return view('admin.devices.create',['consttypeoptions' => $consttypeoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        // dd($request->all());
        $this->authorize('create',Device::class);
        try {
            DB::beginTransaction();
            $record = $this->service->store($request);
            $this->success($this->service->addMsg());
            DB::commit();
            return redirect()->route('devices.index');
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Device $device)
    {
        $this->authorize('update', $device);
        
        		$consttypeoptions = $this->service->getconst("TYPE_SELECT");
		$consttypeoptions = $this->service->dropdown($consttypeoptions,$device->boxtype);

        return view('admin.devices.edit',['device' => $device,'consttypeoptions' => $consttypeoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeviceRequest $request, Device $device)
    {
        $this->authorize('create',Device::class);
        try {
            DB::beginTransaction();
            $record = $this->service->update($device,$request);
            $this->success($this->service->updateMsg());
            DB::commit();
            return redirect()->back();
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {   
        $this->authorize('delete',Device::class);  
        try {
            DB::beginTransaction();
            $this->service->delete($device);
            $this->success($this->service->delMsg());
            DB::commit();
            return redirect()->route('devices.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Device::class);
        try {
            DB::beginTransaction();
            $this->service->deleteall($request);
            $this->success($this->service->delMsg());
            DB::commit();
            return redirect()->route('devices.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->service->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
