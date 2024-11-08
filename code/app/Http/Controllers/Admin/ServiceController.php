<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\App;
use App\Models\Service;

use App\Services\ServiceService;

use Exception;
use DB;
class ServiceController extends WebController
{
    protected  $serviceservice;


    public function __construct(ServiceService $serviceservice)
    {
        $this->serviceservice = $serviceservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Service::class);
        
        $services = $this->serviceservice->paginate($request);
        
        return view('admin.services.index',['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Service::class);
        
        		$conststatusoptions = $this->serviceservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->serviceservice->dropdown($conststatusoptions,old('status'),[],false);

        return view('admin.services.create',['conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $this->authorize('create',Service::class);
        try {
            DB::beginTransaction();
            $record = $this->serviceservice->store($request);
            $this->success($this->serviceservice->addMsg());
            DB::commit();
            return redirect()->route('services.index');
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
    public function show(Service $service)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Service $service)
    {
        $this->authorize('update', $service);
        
        		$conststatusoptions = $this->serviceservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->serviceservice->dropdown($conststatusoptions,$service->status,[],false);

        return view('admin.services.edit',['service' => $service,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('create',Service::class);
        try {
            DB::beginTransaction();
            $record = $this->serviceservice->update($service,$request);
            $this->success($this->serviceservice->updateMsg());
            DB::commit();
            return redirect()->route('services.index');
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
    public function destroy(Service $service)
    {   
        $this->authorize('delete',Service::class);  
        try {
            DB::beginTransaction();
            $this->serviceservice->delete($service);
            $this->success($this->serviceservice->delMsg());
            DB::commit();
            return redirect()->route('services.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Service::class);
        try {
            DB::beginTransaction();
            $this->serviceservice->deleteall($request);
            $this->success($this->serviceservice->delMsg());
            DB::commit();
            return redirect()->route('services.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->serviceservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
