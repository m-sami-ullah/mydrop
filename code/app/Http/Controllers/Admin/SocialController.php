<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
// use App\Http\Requests\SocialRequest;
use App\Models\Social;
use App\Services\SocialService;
use Exception;
use DB;
class SocialController extends WebController
{
    protected  $service;
    public function __construct(SocialService $service)
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
        // $this->authorize('viewAny', Social::class);
        $socials = $this->service->paginate($request);
        return view('admin.socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Social::class);
        return view('admin.socials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create',Social::class);
        try {
            DB::beginTransaction();
            $record = $this->service->store($request);
            $this->success($this->service->addMsg('Social media'));
            DB::commit();
            return redirect()->route('socials.index');
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
    public function show(Social $social)
    {
        //return view('admin/countries/show', ['country'=>$country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        // $this->authorize('update', $social);
        return view('admin.socials.edit', ['social'=>$social]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        // $this->authorize('update', $social);
        try {
            DB::beginTransaction();
            $record = $this->service->update($social,$request);
            $this->success($this->service->updateMsg('Social media'));
            DB::commit();
            return redirect()->route('socials.index');
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
    public function destroy(Social $social)
    {   
        // $this->authorize('delete',Social::class);  
        try {
            DB::beginTransaction();
            $this->service->delete($social);
            $this->success($this->service->delMsg('Social media'));
            DB::commit();
            return redirect()->route('socials.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        // $this->authorize('deleteall', Social::class);
        try {
            DB::beginTransaction();
            $this->service->deleteall($request);
            $this->success($this->service->delMsg('Social media'));
            DB::commit();
            return redirect()->route('socials.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->service->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
}
