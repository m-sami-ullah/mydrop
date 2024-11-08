<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\PackageRequest;
use Illuminate\Support\Facades\App;
use App\Models\Package;

use App\Services\PackageService;

use Exception;
use DB;
class PackageController extends WebController
{
    protected  $packageservice;


    public function __construct(PackageService $packageservice)
    {
        $this->packageservice = $packageservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Package::class);
        
        $packages = $this->packageservice->paginate($request);
        
        return view('admin.packages.index',['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Package::class);
        
        		// $constdurationoptions = $this->packageservice->getconst("DURATION_SELECT");
		// $constdurationoptions = $this->packageservice->dropdown($constdurationoptions,old('duration'));

        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $this->authorize('create',Package::class);
        try {
            DB::beginTransaction();
            $record = $this->packageservice->store($request);
            $this->success($this->packageservice->addMsg());
            DB::commit();
            return redirect()->route('packages.index');
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
    public function show(Package $package)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Package $package)
    {
        $this->authorize('update', $package);
        
        		// $constdurationoptions = $this->packageservice->getconst("DURATION_SELECT");
		// $constdurationoptions = $this->packageservice->dropdown($constdurationoptions,$package->duration);

        return view('admin.packages.edit',['package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, Package $package)
    {
        $this->authorize('create',Package::class);
        try {
            DB::beginTransaction();
            $record = $this->packageservice->update($package,$request);
            $this->success($this->packageservice->updateMsg());
            DB::commit();
            return redirect()->route('packages.index');
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
    public function destroy(Package $package)
    {   
        $this->authorize('delete',Package::class);  
        try {
            DB::beginTransaction();
            $this->packageservice->delete($package);
            $this->success($this->packageservice->delMsg());
            DB::commit();
            return redirect()->route('packages.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Package::class);
        try {
            DB::beginTransaction();
            $this->packageservice->deleteall($request);
            $this->success($this->packageservice->delMsg());
            DB::commit();
            return redirect()->route('packages.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->packageservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
