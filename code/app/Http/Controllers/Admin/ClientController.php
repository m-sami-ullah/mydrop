<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\App;
use App\Models\Client;

use App\Services\ClientService;

use Exception;
use DB;
class ClientController extends WebController
{
    protected  $clientservice;


    public function __construct(ClientService $clientservice)
    {
        $this->clientservice = $clientservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Client::class);
        
        $clients = $this->clientservice->paginate($request);
        
        return view('admin.clients.index',['clients' => $clients] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Client::class);
        
        
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $this->authorize('create',Client::class);
        try {
            DB::beginTransaction();
            $record = $this->clientservice->store($request);
            $this->success($this->clientservice->addMsg());
            DB::commit();
            return redirect()->route('clients.index');
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
    public function show(Client $client)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Client $client)
    {
        $this->authorize('update', $client);
        
        
        return view('admin.clients.edit',['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $this->authorize('create',Client::class);
        try {
            DB::beginTransaction();
            $record = $this->clientservice->update($client,$request);
            $this->success($this->clientservice->updateMsg());
            DB::commit();
            return redirect()->route('clients.index');
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
    public function destroy(Client $client)
    {   
        $this->authorize('delete',Client::class);  
        try {
            DB::beginTransaction();
            $this->clientservice->delete($client);
            $this->success($this->clientservice->delMsg());
            DB::commit();
            return redirect()->route('clients.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Client::class);
        try {
            DB::beginTransaction();
            $this->clientservice->deleteall($request);
            $this->success($this->clientservice->delMsg());
            DB::commit();
            return redirect()->route('clients.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->clientservice->dbException($e));

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
}
