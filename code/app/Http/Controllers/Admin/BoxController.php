<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Requests\BoxRequest;
use Illuminate\Support\Facades\App;
use App\Models\Box;

use App\Services\BoxService;
use App\Services\CustomerService;
use App\Services\AddressService;

use Exception;
use DB;
class BoxController extends WebController
{
    protected  $boxservice;
protected  $customerservice;
protected  $addressservice;


    public function __construct(BoxService $boxservice,CustomerService $customerservice,AddressService $addressservice)
    {
        $this->boxservice = $boxservice;
$this->customerservice = $customerservice;
$this->addressservice = $addressservice;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Box::class);
        
        $boxes = $this->boxservice->paginate($request);
        
        return view('admin.boxes.index',['boxes' => $boxes]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $this->authorize('generate', Box::class);
        
        $constboxtypeoptions = $this->boxservice->getconst("BOXTYPE_SELECT");
        $constboxtypeoptions = $this->boxservice->dropdown($constboxtypeoptions,old('boxtype'),[],false);

        return view('admin.boxes.generate',['constboxtypeoptions' => $constboxtypeoptions]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Box::class);
        
        		$customers = $this->customerservice->get($request);
		$customersoptions = $this->customerservice->dropdown($customers,old('customer_id'),['id','firstname']);
		$addresses = $this->addressservice->get($request);
		$addressesoptions = $this->addressservice->dropdown($addresses,old('address_id'),['id','title']);
		$constboxtypeoptions = $this->boxservice->getconst("BOXTYPE_SELECT");
		$constboxtypeoptions = $this->boxservice->dropdown($constboxtypeoptions,old('boxtype'));
		$conststatusoptions = $this->boxservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->boxservice->dropdown($conststatusoptions,old('status'));

        return view('admin.boxes.create',['customeroptions' => $customersoptions,'addressoptions' => $addressesoptions,'constboxtypeoptions' => $constboxtypeoptions,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoxRequest $request)
    {
        $this->authorize('create',Box::class);
        try {
            DB::beginTransaction();
            $record = $this->boxservice->store($request);
            $this->success($this->boxservice->addMsg());
            DB::commit();
            return redirect()->route('boxes.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_generate(Request $request)
    {
        $this->authorize('create',Box::class);
        try {
            DB::beginTransaction();
            $record = $this->boxservice->store_generate($request);
            $this->success('Box generated successfully');
            DB::commit();
            return redirect()->route('boxes.index');
        }catch (Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
            return $this->error($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Box $box)
    {
        $this->authorize('update', $box);
        
        		$customers = $this->customerservice->get($request);
		$customersoptions = $this->customerservice->dropdown($customers,$box->customer_id,['id','firstname'],true,[],['firstname','lastname'],' ');
		$addresses = $this->addressservice->get($request);
		$addressesoptions = $this->addressservice->dropdown($addresses,$box->address_id,['id','title']);
		$constboxtypeoptions = $this->boxservice->getconst("BOXTYPE_SELECT");
		$constboxtypeoptions = $this->boxservice->dropdown($constboxtypeoptions,$box->boxtype);
		$conststatusoptions = $this->boxservice->getconst("STATUS_SELECT");
		$conststatusoptions = $this->boxservice->dropdown($conststatusoptions,$box->status);

        return view('admin.boxes.edit',['box' => $box,'customeroptions' => $customersoptions,'addressoptions' => $addressesoptions,'constboxtypeoptions' => $constboxtypeoptions,'conststatusoptions' => $conststatusoptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoxRequest $request, Box $box)
    {
        $this->authorize('create',Box::class);
        try {
            DB::beginTransaction();
            $record = $this->boxservice->update_box($box,$request);
            $this->success($this->boxservice->updateMsg());
            DB::commit();
            return redirect()->route('boxes.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deviceinfo(Request $request)
    {
        // dd($request->all());
        $url = $request->url;
        $data = '{ 
                "deviceid": "", 
                "data": {
                  
                } 
             }';
        $curl = curl_init();

            curl_setopt_array($curl, array(
              // CURLOPT_URL => $url,
              CURLOPT_URL => 'http://mydropbox.ddns.net:1010/zeroconf/info',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>$data,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            // $responseInfo = curl_getinfo($curl);
            // dd($responseInfo);
            // curl_close($curl);
            $err_no = curl_errno($curl);
            curl_close($curl);
            // dd($response);
            // dd($err_no);
            // $err = curl_error($curl);
            // curl_close($curl);
            if ($err_no) {
                echo "cURL Error #:" . $err_no;
            // dd($err,$err_no);
            } else {
                return $response;
                // eprint_r(json_decode($response));
            }
    }
    public function doortoogle(Request $request)
    { 
        
        $payload = $request->input('payload'); 
        $url = $request->input('url'); 
        $data = json_encode($payload);
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>$data,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            $responseInfo = curl_getinfo($curl);
            $err_no = curl_errno($curl);
            curl_close($curl);

            if ($err_no) {
                // echo "cURL Error #:" . $err_no;
                throw new Exception($err_no, 1);
                
            } else {
                return $response;
            }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {   
        $this->authorize('delete',Box::class);  
        try {
            DB::beginTransaction();
            $this->boxservice->delete($box);
            $this->success($this->boxservice->delMsg());
            DB::commit();
            return redirect()->route('boxes.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        $this->authorize('deleteall', Box::class);
        try {
            DB::beginTransaction();
            $this->boxservice->deleteall($request);
            $this->success($this->boxservice->delMsg());
            DB::commit();
            return redirect()->route('boxes.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->boxservice->dbException($e));

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
