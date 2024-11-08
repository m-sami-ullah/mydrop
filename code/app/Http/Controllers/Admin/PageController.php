<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\App;
use App\Models\Page;

use App\Services\PageService;

use Exception;
use DB;
class PageController extends WebController
{
    protected  $pageservice;


    public function __construct(PageService $pageservice)
    {
        $this->pageservice = $pageservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Page::class);
        
        $pages = $this->pageservice->paginate($request);
        
        return view('admin.pages.index',['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Page::class);
        
        		$constrobotsoptions = $this->pageservice->getconst("ROBOTS_RADIO");
		$constrobotsoptions = $this->pageservice->dropdown($constrobotsoptions,old('robots'));

        return view('admin.pages.create',['constrobotsoptions' => $constrobotsoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $this->authorize('create',Page::class);
        try {
            DB::beginTransaction();
            $record = $this->pageservice->store($request);
            $this->success($this->pageservice->addMsg());
            DB::commit();
            return redirect()->route('pages.index');
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
    public function home(Request $request)
    {
        return view('admin.pages.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Page $page)
    {
        $this->authorize('update', $page);
        
        		$constrobotsoptions = $this->pageservice->getconst("ROBOTS_RADIO");
		$constrobotsoptions = $this->pageservice->dropdown($constrobotsoptions,$page->robots);

        return view('admin.pages.edit',['page' => $page,'constrobotsoptions' => $constrobotsoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $this->authorize('create',Page::class);
        try {
            DB::beginTransaction();
            $record = $this->pageservice->update($page,$request);
            $this->success($this->pageservice->updateMsg());
            DB::commit();
            return redirect()->route('pages.index');
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
    public function destroy(Page $page)
    {   
        $this->authorize('delete',Page::class);  
        try {
            DB::beginTransaction();
            $this->pageservice->delete($page);
            $this->success($this->pageservice->delMsg());
            DB::commit();
            return redirect()->route('pages.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Page::class);
        try {
            DB::beginTransaction();
            $this->pageservice->deleteall($request);
            $this->success($this->pageservice->delMsg());
            DB::commit();
            return redirect()->route('pages.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->pageservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
