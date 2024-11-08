<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\App;
use App\Models\Address;

use App\Services\AddressService;
use App\Services\StateService;
use App\Services\CityService;
use App\Services\AreaService;
use App\Models\Customer;
use App\Services\CustomerService;

use Exception;
use DB;
class AddressController extends WebController
{
    protected  $addressservice;
protected  $stateservice;
protected  $cityservice;
protected  $areaservice;
protected  $customerservice;


    public function __construct(AddressService $addressservice,StateService $stateservice,CityService $cityservice,AreaService $areaservice,CustomerService $customerservice)
    {
        $this->addressservice = $addressservice;
$this->stateservice = $stateservice;
$this->cityservice = $cityservice;
$this->areaservice = $areaservice;
$this->customerservice = $customerservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Customer $customer)
    {
        $this->authorize('viewAny', Address::class);
        $request["customer_id"] = $customer->id;

        $addresses = $this->addressservice->paginate($request);
        
        return view('admin.addresses.index',['addresses' => $addresses,'customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Customer $customer)
    {
        $this->authorize('create', Address::class);
        $request["customer_id"] = $customer->id;

        		$states = $this->stateservice->get($request);
		$statesoptions = $this->stateservice->dropdown($states,old('state_id'),['id','name']);
		$cities = $this->cityservice->get($request);
		$citiesoptions = $this->cityservice->dropdown($cities,old('city_id'),['id','name']);
		$areas = $this->areaservice->get($request);
		$areasoptions = $this->areaservice->dropdown($areas,old('area_id'),['id','name']);

        return view('admin.addresses.create',['stateoptions' => $statesoptions,'cityoptions' => $citiesoptions,'areaoptions' => $areasoptions,'customer' => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Customer $customer,AddressRequest $request)
    {
        $this->authorize('create',Address::class);
        try {
            DB::beginTransaction();
            $record = $this->addressservice->store($request);
            $this->success($this->addressservice->addMsg());
            DB::commit();
            return redirect()->route('customers.addresses.index',['customer'=>$customer->id]);
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
    public function show(Customer $customer,Address $address)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Customer $customer,Address $address)
    {
        $this->authorize('update', $address);
        $request["customer_id"] = $customer->id;

        		$states = $this->stateservice->get($request);
		$statesoptions = $this->stateservice->dropdown($states,$address->state_id,['id','name']);
		$cities = $this->cityservice->get($request);
		$citiesoptions = $this->cityservice->dropdown($cities,$address->city_id,['id','name']);
		$areas = $this->areaservice->get($request);
		$areasoptions = $this->areaservice->dropdown($areas,$address->area_id,['id','name']);

        return view('admin.addresses.edit',['address' => $address,'stateoptions' => $statesoptions,'cityoptions' => $citiesoptions,'areaoptions' => $areasoptions,'customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer,AddressRequest $request, Address $address)
    {
        $this->authorize('create',Address::class);
        try {
            DB::beginTransaction();
            $record = $this->addressservice->update($address,$request);
            $this->success($this->addressservice->updateMsg());
            DB::commit();
            return redirect()->route('customers.addresses.index',['customer'=>$customer->id]);
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
    public function destroy(Customer $customer,Address $address)
    {   
        $this->authorize('delete',Address::class);  
        try {
            DB::beginTransaction();
            $this->addressservice->delete($address);
            $this->success($this->addressservice->delMsg());
            DB::commit();
            return redirect()->route('customers.addresses.index',['customer'=>$customer->id]);
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request,Customer $customer)
    {

        $this->authorize('deleteall', Address::class);
        try {
            DB::beginTransaction();
            $this->addressservice->deleteall($request);
            $this->success($this->addressservice->delMsg());
            DB::commit();
            return redirect()->route('customers.addresses.index',['customer'=>$customer->id]);
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->addressservice->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
