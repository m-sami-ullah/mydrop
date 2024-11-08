<?php

namespace App\Http\Controllers\Customer;
use App\Helper\Filemgr;
use App\Http\Controllers\WebController;
use App\Http\Requests\BoxRequest;
use App\Models\Box;
use App\Models\Image;
use App\Services\AddressService;
use App\Services\BoxService;
use App\Services\CustomerService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class CustomerBoxController extends WebController
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
        $boxes = $this->boxservice->paginate($request);
        // $boxes = $this->boxservice->gallery($request);

        return view('customer.boxes.index',['boxes' => $boxes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        $gallery = $box->images()->latest()->get();

        return view('customer.boxes.view',['box' => $box,'gallery' => $gallery]);
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
        try {
            $payload = $request->input('payload'); 
            $url = $request->input('url'); 
            $boxid = $request->input('boxid'); 
            $camera_url = $request->input('curl'); 
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
                    $this->capctureImage($camera_url,$boxid);
                    return $response;
                }
        } catch (Exception $e) {
             return $this->apierror($e->getMessage());
        }
    }

    public function capctureImage($camera_url,$boxid)
    {
        $directory = auth('customer')->user()->id .'/'. $boxid;
        $filename = Filemgr::copyfile($camera_url,$directory);

        Image::create(['name'=>$filename,'customer_id'=>auth('customer')->user()->id,'box_id'=>$boxid,'status'=>1]);

    }
    public function getgallery(Request $request,Box $box)
    {
         try {
            $record = $this->boxservice->getgallery($box,$request);
            $data  = view('customer.boxes.gallery',['gallery'=>$record])->render();
            // dd($data);
            return $this->apisuccess($data);
        }catch (Exception $e) {
            DB::rollback();
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
   
}
