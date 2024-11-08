<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\App;
use App\Models\Country;

use App\Services\CountryService;

use Exception;
use DB;
class CountryController extends WebController
{
    protected  $countryservice;


    public function __construct(CountryService $countryservice)
    {
        $this->countryservice = $countryservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Country::class);
        
        $countries = $this->countryservice->paginate($request);
        
        return view('admin.countries.index',['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Country::class);
        
        
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $this->authorize('create',Country::class);
        try {
            DB::beginTransaction();
            $record = $this->countryservice->store($request);
            $this->success($this->countryservice->addMsg());
            DB::commit();
            return redirect()->route('countries.index');
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
    public function show(Country $country)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Country $country)
    {
        $this->authorize('update', $country);
        
        
        return view('admin.countries.edit',['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $this->authorize('create',Country::class);
        try {
            DB::beginTransaction();
            $record = $this->countryservice->update($country,$request);
            $this->success($this->countryservice->updateMsg());
            DB::commit();
            return redirect()->route('countries.index');
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
    public function destroy(Country $country)
    {   
        $this->authorize('delete',Country::class);  
        try {
            DB::beginTransaction();
            $this->countryservice->delete($country);
            $this->success($this->countryservice->delMsg());
            DB::commit();
            return redirect()->route('countries.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Country::class);
        try {
            DB::beginTransaction();
            $this->countryservice->deleteall($request);
            $this->success($this->countryservice->delMsg());
            DB::commit();
            return redirect()->route('countries.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->countryservice->dbException($e));

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
