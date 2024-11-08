<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\App;
use App\Models\Banner;

use App\Services\BannerService;

use Exception;
use DB;
class BannerController extends WebController
{
    protected  $bannerservice;


    public function __construct(BannerService $bannerservice)
    {
        $this->bannerservice = $bannerservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Banner::class);
        
        $banners = $this->bannerservice->paginate($request);
        
        return view('admin.banners.index',['banners' => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Banner::class);
        
        		$conststatusoptions = $this->bannerservice->getconst("STATUS_RADIO");
		$conststatusoptions = $this->bannerservice->dropdown($conststatusoptions,old('status'));

        return view('admin.banners.create',['conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $this->authorize('create',Banner::class);
        try {
            DB::beginTransaction();
            $record = $this->bannerservice->store($request);
            $this->success($this->bannerservice->addMsg());
            DB::commit();
            return redirect()->route('banners.index');
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
    public function show(Banner $banner)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Banner $banner)
    {
        $this->authorize('update', $banner);
        
        		$conststatusoptions = $this->bannerservice->getconst("STATUS_RADIO");
		$conststatusoptions = $this->bannerservice->dropdown($conststatusoptions,$banner->status);

        return view('admin.banners.edit',['banner' => $banner,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $this->authorize('create',Banner::class);
        try {
            DB::beginTransaction();
            $record = $this->bannerservice->update($banner,$request);
            $this->success($this->bannerservice->updateMsg());
            DB::commit();
            return redirect()->route('banners.index');
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
    public function destroy(Banner $banner)
    {   
        $this->authorize('delete',Banner::class);  
        try {
            DB::beginTransaction();
            $this->bannerservice->delete($banner);
            $this->success($this->bannerservice->delMsg());
            DB::commit();
            return redirect()->route('banners.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Banner::class);
        try {
            DB::beginTransaction();
            $this->bannerservice->deleteall($request);
            $this->success($this->bannerservice->delMsg());
            DB::commit();
            return redirect()->route('banners.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->bannerservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
