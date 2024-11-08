<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\SiteconfigRequest;
use Illuminate\Support\Facades\App;
use App\Models\Siteconfig;
use App\Services\SiteconfigService;
use Exception;
use DB;
class SiteconfigController extends WebController
{
    protected  $service;
    public function __construct(SiteconfigService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siteconfig $config)
    {
        // dd($config);
        $this->authorize('update', $config);
        return view('admin.config.edit', ['config'=>$config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteconfigRequest $request, Siteconfig $config)
    {
        
        $this->authorize('update',$config);
        try {
            DB::beginTransaction();
            $record = $this->service->update($config,$request);
            $this->success($this->service->updateMsg('Configuration'));
            DB::commit();
            return redirect()->route('config.edit',['config'=>$config->id]);
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function notifications()
    {
        // $conf = $this->model::find(1);
        return view('admin.config.notifications');
    }
 
}
