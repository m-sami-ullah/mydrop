<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\BoxRequest;
use App\Models\Address;
use App\Models\Box;
use App\Models\Customer;
use App\Services\AddressService;
use App\Services\AreaService;
use App\Services\BoxService;
use App\Services\CityService;
use App\Services\CustomerService;
use App\Services\DeviceService;
use App\Services\StateService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class CustomerBoxController extends WebController
{
    protected  $service;
    protected  $deviceservice;
    protected  $addressservice;
protected  $stateservice;
protected  $cityservice;
protected  $areaservice;
protected  $customerservice;


    public function __construct(BoxService $service,DeviceService $deviceservice,AddressService $addressservice,StateService $stateservice,CityService $cityservice,AreaService $areaservice,CustomerService $customerservice)
    {
        $this->service = $service;
        $this->deviceservice = $deviceservice;
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
    public function index(Request $request,Customer $customer,Address $address)
    {
        $this->authorize('viewAny', Box::class);
        $request["customer_id"] = $customer->id;
        $request["address_id"] = $address->id;

        $boxes = $this->service->paginate($request);
        // dd($boxes);
        
        return view('admin.addresses.boxes.index',['boxes' => $boxes,'customer' => $customer,'address' => $address]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Customer $customer,Address $address)
    {
        $this->authorize('create', Box::class);
        $request["customer_id"] = $customer->id;
        $switch_request = $request;
        $switches = $this->deviceservice->get($switch_request->merge(['type'=>1]));
		$switches = $this->deviceservice->dropdown($switches,old('switch_id'),['id','name'],true,[],['name','deviceid','model'],' - ');

        $camera_request = $request;
        $cameras = $this->deviceservice->get($camera_request->merge(['type'=>2]));
		$cameras = $this->deviceservice->dropdown($cameras,old('camera_id'),['id','name']);

        $statusoptions = $this->service->getconst("STATUS_SELECT");
        $statusoptions = $this->service->dropdown($statusoptions,old('status'));

       /* $sensor_request = $request;
		$sensors = $this->deviceservice->get($sensor_request->merge(['type'=>3]));
		$sensors = $this->deviceservice->dropdown($sensors,old('sensor_id'),['id','name']);
        'sensors' => $sensors,
        */

        return view('admin.addresses.boxes.create',['switches' => $switches,'cameras' => $cameras,'customer' => $customer,'address' => $address,'statusoptions' => $statusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoxRequest $request,Customer $customer,Address $address)
    {
        $this->authorize('create',Box::class);
        try {
            DB::beginTransaction();
            $record = $this->service->store($request);
            $this->success($this->service->addMsg());
            DB::commit();
            return redirect()->route('customers.addresses.boxes.index',['customer'=>$customer->id,'address'=>$address->id]);
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
    public function edit(Request $request,Customer $customer,Address $address,Box $box)
    {
        $this->authorize('update', $box);

		 $switch_request = $request;
        $switches = $this->deviceservice->get($switch_request->merge(['type'=>1]));
        $switches = $this->deviceservice->dropdown($switches,old('switch_id',$box->switch_id),['id','name'],true,[],['name','deviceid','model'],' - ');

        $camera_request = $request;
        $cameras = $this->deviceservice->get($camera_request->merge(['type'=>2]));
        $cameras = $this->deviceservice->dropdown($cameras,old('camera_id',$box->camera_id),['id','name']);

        $statusoptions = $this->service->getconst("STATUS_SELECT");
        $statusoptions = $this->service->dropdown($statusoptions,old('status',$box->status));

        return view('admin.addresses.boxes.edit',['switches' => $switches,'cameras' => $cameras,'customer' => $customer,'address' => $address,'statusoptions' => $statusoptions,'box'=>$box]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoxRequest $request,Customer $customer, Address $address,Box $box)
    {
        $this->authorize('update',$box);
        try {
            DB::beginTransaction();
            $record = $this->service->update($box,$request);
            $this->success($this->service->updateMsg());
            DB::commit();
            return redirect()->route('customers.addresses.boxes.edit',['customer'=>$customer->id,'address'=>$address->id,'box'=>$box->id]);
        }catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,Address $address,Box $box)
    {   
        $this->authorize('delete',Box::class);  
        try {
            DB::beginTransaction();
            $this->service->delete($box);
            $this->success($this->service->delMsg());
            DB::commit();
            return redirect()->route('customers.addresses.boxes.index',['customer'=>$customer->id,'address'=>$address->id]);
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request,Customer $customer,Address $address,Box $box)
    {

        $this->authorize('deleteall', Box::class);
        try {
            DB::beginTransaction();
            $this->service->deleteall($request);
            $this->success($this->service->delMsg());
            DB::commit();
            return redirect()->route('customers.addresses.boxes.index',['customer'=>$customer->id,'address'=>$address->id]);
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->service->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    
}
