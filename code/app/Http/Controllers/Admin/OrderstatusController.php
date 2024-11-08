<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\OrderstatusRequest;
use Illuminate\Support\Facades\App;
use App\Models\Orderstatus;

use App\Services\OrderstatusService;

use Exception;
use DB;
class OrderstatusController extends WebController
{
    protected  $orderstatusservice;


    public function __construct(OrderstatusService $orderstatusservice)
    {
        $this->orderstatusservice = $orderstatusservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Orderstatus::class);
        
        $orderstatuses = $this->orderstatusservice->paginate($request);
        
        return view('admin.orderstatuses.index',['orderstatuses' => $orderstatuses] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Orderstatus::class);
        
        
        return view('admin.orderstatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderstatusRequest $request)
    {
        $this->authorize('create',Orderstatus::class);
        try {
            DB::beginTransaction();
            $record = $this->orderstatusservice->store($request);
            $this->success($this->orderstatusservice->addMsg());
            DB::commit();
            return redirect()->route('orderstatuses.index');
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
    public function show(Orderstatus $orderstatus)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Orderstatus $orderstatus)
    {
        $this->authorize('update', $orderstatus);
        
        
        return view('admin.orderstatuses.edit',['orderstatus' => $orderstatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderstatusRequest $request, Orderstatus $orderstatus)
    {
        $this->authorize('create',Orderstatus::class);
        try {
            DB::beginTransaction();
            $record = $this->orderstatusservice->update($orderstatus,$request);
            $this->success($this->orderstatusservice->updateMsg());
            DB::commit();
            return redirect()->route('orderstatuses.index');
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
    public function destroy(Orderstatus $orderstatus)
    {   
        $this->authorize('delete',Orderstatus::class);  
        try {
            DB::beginTransaction();
            $this->orderstatusservice->delete($orderstatus);
            $this->success($this->orderstatusservice->delMsg());
            DB::commit();
            return redirect()->route('orderstatuses.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Orderstatus::class);
        try {
            DB::beginTransaction();
            $this->orderstatusservice->deleteall($request);
            $this->success($this->orderstatusservice->delMsg());
            DB::commit();
            return redirect()->route('orderstatuses.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->orderstatusservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
			public function getclient(Request $request)
			{
			    $client = Client::where("id",$request->record_id)->first();
			    $this->authorize("update", $client);
			
			    echo $data = view("admin.clients.edit" ,['client' => $client])->render();
			}
			public function getorderstatus(Request $request)
			{
			    $orderstatus = Orderstatus::where("id",$request->record_id)->first();
			    $this->authorize("update", $orderstatus);
			
			    echo $data = view("admin.orderstatuses.edit" ,['orderstatus' => $orderstatus])->render();
			}
}
