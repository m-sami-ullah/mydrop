<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Nav;
use App\Services\MenuService;
use App\Services\NavService;
use Exception;
use DB;
class MenuController extends WebController
{
    protected  $service;
    protected  $navservice;
    public function __construct(MenuService $service,NavService $navservice)
    { 
        $this->service = $service;
        $this->navservice = $navservice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('viewAny', Category::class);
        $menu = $this->navservice->paginate($request);
        // return view('admin.menu.index');
        return view('admin.menu.index', compact('menu'));
    }

    public function menu(Request $request,Nav $nav)
    {
        // $this->authorize('viewAny', Category::class);
        $menu = $this->service->getMenu($nav->id);
        // return view('admin.menu.index');
        return view('admin.menu.links',compact('nav','menu'));
    }

    public function edit(Request $request,Nav $nav)
    {
        // $this->authorize('viewAny', Category::class);
        // $menu = $this->service->getMenu($nav->id);
        // return view('admin.menu.index');
        return view('admin.menu.edit',compact('nav'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nav $nav)
    {

        // $this->authorize('update', $nav);
        try {
            
            $record = $this->navservice->edit($nav,$request);
            $this->success($this->navservice->updateMsg('Menu'));
            
            return redirect()->route('nav.index');
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatemenu(Request $request, Nav $nav)
    {
        // $this->authorize('update', $nav);
        try {
            
            $record = $this->service->editmenu($nav,$request);
            $this->success($this->service->updateMsg('Menu'));
            
            return redirect()->route('menu.links',['nav'=>$nav->id]);
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addpage(Request $request,Nav $nav)
    {
        // dd('--');
        // $this->authorize('create',Menu::class);
        try {
            DB::beginTransaction();
            $record = $this->service->addPage($request,$nav->id);
            $this->success($this->service->updateMsg('Menu'));
            DB::commit();
            return redirect()->route('menu.links',['nav'=>$nav->id]);
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addcustom(Request $request,Nav $nav)
    {
        // $this->authorize('create',Menu::class);
        try {
            DB::beginTransaction();
            $record = $this->service->addcustom($request,$nav->id);
            $this->success($this->service->updateMsg('Menu'));
            DB::commit();
            return redirect()->route('menu.links',['nav'=>$nav->id]);
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addcategory(Request $request,Nav $nav)
    {
        // $this->authorize('create',Menu::class);
        try {
            DB::beginTransaction();
            $record = $this->service->addCategory($request,$nav->id);
            $this->success($this->service->updateMsg('Menu'));
            DB::commit();
            return redirect()->route('menu.links',['nav'=>$nav->id]);
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_menu(Request $request,Nav $nav,Menu $menu)
    {
        // dd($nav,$menu);
        // $this->authorize('create',Menu::class);
        try {
            DB::beginTransaction();
            $record = $this->service->delete_menu($request,$nav->id,$menu);
            $this->success($this->service->delMsg('Link'));
            DB::commit();
            return redirect()->route('menu.links',['nav'=>$nav->id]);
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }

    }

     
}
