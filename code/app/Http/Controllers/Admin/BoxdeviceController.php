<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use App\Http\Requests\BoxdeviceRequest;
use App\Models\Address;
use App\Models\Box;
use App\Models\Boxdevice;
use App\Models\Customer;
use App\Models\Device;
use App\Services\BoxService;
use App\Services\BoxdeviceService;
use App\Services\DeviceService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class BoxdeviceController extends WebController
{
    protected  $boxdeviceservice;
protected  $boxservice;
protected  $deviceservice;


    public function __construct(BoxdeviceService $boxdeviceservice,BoxService $boxservice,DeviceService $deviceservice)
    {
        $this->boxdeviceservice = $boxdeviceservice;
$this->boxservice = $boxservice;
$this->deviceservice = $deviceservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Box $box)
    {
        $this->authorize('viewAny', Boxdevice::class);
        $request["box_id"] = $box->id;

        $boxdevices = $this->boxdeviceservice->paginate($request);
        
        return view('admin.boxdevices.index',['boxdevices' => $boxdevices,'box' => $box]);
    }


    public function customer_device(Request $request,Customer $customer,Address $address,Box $box)
    {
        
        $this->authorize('viewAny', Boxdevice::class);
        // return view('admin.customer.address.devices.index',['switches' => $switches,'box' => $box]);
        $request["box_id"] = $box->id;

        $device_ids = [];
        $devices = Boxdevice::where('box_id',$box->id)->get();
        if ($devices->count()) 
        {
            $device_ids = $devices->pluck('device_id');
        }
        // dd($device_ids);
        $switches = Device::switches()->whereIn('id',$device_ids)->get();
        $cameras = Device::camera()->whereIn('id',$device_ids)->get();
        return view('admin.addresses.boxes.devices.index',['switches' => $switches,'box' => $box,'cameras'=>$cameras]);
        // dd($switches);
        // return view('admin.boxdevices.index',['switches' => $switches,'box' => $box]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Box $box)
    {
        $this->authorize('create', Boxdevice::class);
        $request["box_id"] = $box->id;

        		$devices = $this->deviceservice->get($request);
		$devicesoptions = $this->deviceservice->dropdown($devices,old('device_id'),['id','name']);
		$conststatusoptions = $this->boxdeviceservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->boxdeviceservice->dropdown($conststatusoptions,old('status'));

        return view('admin.boxdevices.create',['box' => $box,'deviceoptions' => $devicesoptions,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Box $box,BoxdeviceRequest $request)
    {
        $this->authorize('create',Boxdevice::class);
        try {
            DB::beginTransaction();
            $record = $this->boxdeviceservice->store($request);
            $this->success($this->boxdeviceservice->addMsg());
            DB::commit();
            return redirect()->route('boxes.boxdevices.index',['box'=>$box->id]);
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
    public function show(Box $box,Boxdevice $boxdevice)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Box $box,Boxdevice $boxdevice)
    {
        $this->authorize('update', $boxdevice);
        $request["box_id"] = $box->id;

        $device = $boxdevice->device;
        		$devices = $this->deviceservice->get($request);
		$devicesoptions = $this->deviceservice->dropdown($devices,$boxdevice->device_id,['id','name']);
		$conststatusoptions = $this->boxdeviceservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->boxdeviceservice->dropdown($conststatusoptions,$boxdevice->status);

        $consttypeoptions = $this->deviceservice->getconst("TYPE_SELECT");
        $consttypeoptions = $this->deviceservice->dropdown($consttypeoptions,$device->boxtype);

        return view('admin.boxdevices.edit',['boxdevice' => $boxdevice,'box' => $box,'deviceoptions' => $devicesoptions,'conststatusoptions' => $conststatusoptions,'device'=>$device,'consttypeoptions' => $consttypeoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Box $box,BoxdeviceRequest $request, Boxdevice $boxdevice)
    {
        $this->authorize('create',Boxdevice::class);
        try {
            DB::beginTransaction();
            $record = $this->boxdeviceservice->update($boxdevice,$request);
            $this->success($this->boxdeviceservice->updateMsg());
            DB::commit();
            return redirect()->route('boxes.boxdevices.index',['box'=>$box->id]);
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
    public function destroy(Box $box,Boxdevice $boxdevice)
    {   
        $this->authorize('delete',Boxdevice::class);  
        try {
            DB::beginTransaction();
            $this->boxdeviceservice->delete($boxdevice);
            $this->success($this->boxdeviceservice->delMsg());
            DB::commit();
            return redirect()->route('boxes.boxdevices.index',['box'=>$box->id]);
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request,Box $box)
    {

        $this->authorize('deleteall', Boxdevice::class);
        try {
            DB::beginTransaction();
            $this->boxdeviceservice->deleteall($request);
            $this->success($this->boxdeviceservice->delMsg());
            DB::commit();
            return redirect()->route('boxes.boxdevices.index',['box'=>$box->id]);
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->boxdeviceservice->dbException($e));

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
