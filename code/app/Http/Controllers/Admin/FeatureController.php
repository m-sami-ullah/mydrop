<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\FeatureRequest;
use Illuminate\Support\Facades\App;
use App\Models\Feature;

use App\Services\FeatureService;
use App\Models\Package;
use App\Services\PackageService;

use Exception;
use DB;
class FeatureController extends WebController
{
    protected  $featureservice;
protected  $packageservice;


    public function __construct(FeatureService $featureservice,PackageService $packageservice)
    {
        $this->featureservice = $featureservice;
$this->packageservice = $packageservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Package $package)
    {
        $this->authorize('viewAny', Feature::class);
        $request["package_id"] = $package->id;

        $features = $this->featureservice->paginate($request);
        
        return view('admin.features.index',['features' => $features,'package' => $package]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Package $package)
    {
        $this->authorize('create', Feature::class);
        $request["package_id"] = $package->id;

        
        return view('admin.features.create',['package' => $package]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Package $package,FeatureRequest $request)
    {
        $this->authorize('create',Feature::class);
        try {
            DB::beginTransaction();
            $record = $this->featureservice->store($request);
            $this->success($this->featureservice->addMsg());
            DB::commit();
            return redirect()->route('packages.features.index',['package'=>$package->id]);
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
    public function show(Package $package,Feature $feature)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Package $package,Feature $feature)
    {
        $this->authorize('update', $feature);
        $request["package_id"] = $package->id;

        
        return view('admin.features.edit',['feature' => $feature,'package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Package $package,FeatureRequest $request, Feature $feature)
    {
        $this->authorize('create',Feature::class);
        try {
            DB::beginTransaction();
            $record = $this->featureservice->update($feature,$request);
            $this->success($this->featureservice->updateMsg());
            DB::commit();
            return redirect()->route('packages.features.index',['package'=>$package->id]);
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
    public function destroy(Package $package,Feature $feature)
    {   
        $this->authorize('delete',Feature::class);  
        try {
            DB::beginTransaction();
            $this->featureservice->delete($feature);
            $this->success($this->featureservice->delMsg());
            DB::commit();
            return redirect()->route('packages.features.index',['package'=>$package->id]);
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request,Package $package)
    {

        $this->authorize('deleteall', Feature::class);
        try {
            DB::beginTransaction();
            $this->featureservice->deleteall($request);
            $this->success($this->featureservice->delMsg());
            DB::commit();
            return redirect()->route('packages.features.index',['package'=>$package->id]);
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->featureservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
