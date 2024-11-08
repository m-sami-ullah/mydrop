<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\ApiController;
use App\Http\Requests\BoxRequest;
use App\Models\Box;
use App\Services\AddressService;
use App\Services\BoxService;
use App\Services\CustomerService;
use App\Services\DeviceService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class CustomerBoxController extends ApiController
{
    protected  $boxservice;
protected  $customerservice;
protected  $addressservice;
protected  $deviceservice;


    public function __construct(BoxService $boxservice,CustomerService $customerservice,AddressService $addressservice,DeviceService $deviceservice)
    {
        $this->boxservice = $boxservice;
        $this->customerservice = $customerservice;
        $this->addressservice = $addressservice;
        $this->deviceservice = $deviceservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $boxes = $this->boxservice->paginate($request);
        $boxes = Box::with(['customer','customer.addresses'])->paginate();
        // return view('customer.boxes.index',['boxes' => $boxes]);

        $boxes = $this->boxservice->collection($boxes);
        return $this->success($boxes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        $switches = $box->switches();

        $switches = $this->deviceservice->collection($switches);

        $data['devices'] = $switches;
        $data['gallery'] $this->boxservice->collection($box->images,'Image');

        return $this->success($data);
        // return view('customer.boxes.view',['box' => $box]);
    }

     
 
   
}
