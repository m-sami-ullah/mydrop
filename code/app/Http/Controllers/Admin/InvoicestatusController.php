<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\InvoicestatusRequest;
use Illuminate\Support\Facades\App;
use App\Models\Invoicestatus;

use App\Services\InvoicestatusService;

use Exception;
use DB;
class InvoicestatusController extends WebController
{
    protected  $invoicestatusservice;


    public function __construct(InvoicestatusService $invoicestatusservice)
    {
        $this->invoicestatusservice = $invoicestatusservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Invoicestatus::class);
        
        $invoicestatuses = $this->invoicestatusservice->paginate($request);
        
        return view('admin.invoicestatuses.index',['invoicestatuses' => $invoicestatuses] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Invoicestatus::class);
        
        
        return view('admin.invoicestatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoicestatusRequest $request)
    {
        $this->authorize('create',Invoicestatus::class);
        try {
            DB::beginTransaction();
            $record = $this->invoicestatusservice->store($request);
            $this->success($this->invoicestatusservice->addMsg());
            DB::commit();
            return redirect()->route('invoicestatuses.index');
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
    public function show(Invoicestatus $invoicestatus)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Invoicestatus $invoicestatus)
    {
        $this->authorize('update', $invoicestatus);
        
        
        return view('admin.invoicestatuses.edit',['invoicestatus' => $invoicestatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoicestatusRequest $request, Invoicestatus $invoicestatus)
    {
        $this->authorize('create',Invoicestatus::class);
        try {
            DB::beginTransaction();
            $record = $this->invoicestatusservice->update($invoicestatus,$request);
            $this->success($this->invoicestatusservice->updateMsg());
            DB::commit();
            return redirect()->route('invoicestatuses.index');
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
    public function destroy(Invoicestatus $invoicestatus)
    {   
        $this->authorize('delete',Invoicestatus::class);  
        try {
            DB::beginTransaction();
            $this->invoicestatusservice->delete($invoicestatus);
            $this->success($this->invoicestatusservice->delMsg());
            DB::commit();
            return redirect()->route('invoicestatuses.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Invoicestatus::class);
        try {
            DB::beginTransaction();
            $this->invoicestatusservice->deleteall($request);
            $this->success($this->invoicestatusservice->delMsg());
            DB::commit();
            return redirect()->route('invoicestatuses.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->invoicestatusservice->dbException($e));

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
			public function getinvoicestatus(Request $request)
			{
			    $invoicestatus = Invoicestatus::where("id",$request->record_id)->first();
			    $this->authorize("update", $invoicestatus);
			
			    echo $data = view("admin.invoicestatuses.edit" ,['invoicestatus' => $invoicestatus])->render();
			}
}
