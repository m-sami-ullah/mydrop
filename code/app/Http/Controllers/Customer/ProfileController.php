<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\WebController;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AddressRequest;
use App\Models\Customer;
use App\Services\AddressService;
use App\Services\ProfileService;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;
use Notification;
use Validator;
class ProfileController extends WebController
{

    protected  $service;
    protected  $addressservice;
    public function __construct(ProfileService $service,AddressService $addressservice)
    {

        $this->service = $service;
        $this->addressservice = $addressservice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('customer.profile.index');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        return view('customer.profile.account');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        return view('customer.profile.orders');
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addresses()
    {
        return view('customer.profile.addresses');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_address()
    {
        return view('customer.profile.add_address');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_address (AddressRequest $request)
    {
        $request->merge(['customer'=>Auth::guard('customer')->user()]);
        try {
            DB::beginTransaction();
            $record = $this->addressservice->store($request);
            $this->success($this->addressservice->addMsg());
            DB::commit();
            return redirect()->route('customer.addresses');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepassword()
    {
        return view('customer.profile.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request)
    {
        $validator = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation'  => 'required'
        ]);
        try {
            DB::beginTransaction();
            $record = $this->service->update_password($request);
            $this->success($this->service->updateMsg('Password'));
            DB::commit();
            return redirect()->route('customer.changepassword');
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
    public function save_account(AccountRequest $request)
    {
        try {
            DB::beginTransaction();
            $record = $this->service->save_account($request);
            $this->success($this->service->updateMsg('Account'));
            DB::commit();
            return redirect()->route('customer.account');
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
    public function update(CategoryRequest $request, Category $category)
    {
        // $this->authorize('create',Category::class);
        try {
            DB::beginTransaction();
            $record = $this->service->update($category,$request);
            $this->success($this->service->updateMsg());
            DB::commit();
            return redirect()->route('categories.index');
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
    public function destroy(Category $category)
    {   
        // $this->authorize('delete',Category::class);  
        try {
            DB::beginTransaction();
            $this->service->deletelang($category);
            $this->success($this->service->delMsg());
            DB::commit();
            return redirect()->route('categories.index');
        }catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function deleteall(Request $request)
    {

        // $this->authorize('deleteall', Category::class);
        try {
            DB::beginTransaction();
            $this->service->deletealllang($request);
            $this->success($this->service->delMsg());
            DB::commit();
            return redirect()->route('categories.index');
        }catch (\Illuminate\Database\QueryException $e) {
           DB::rollback();
            return $this->error($this->service->dbException($e));

        } catch (Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    // send phone varify code
    public function sendphonecode(Request $request)
    {
        $seller = Auth::guard('customer')->user(); 
        
        $validator = Validator::make($request->all(), [
            'phone' =>  'required|unique:customers,phone,'.$seller->id,
        ]);

        if ($validator->fails()) 
        {
            return $this->apierror($validator->errors()->first(),422);
        }

                
        $code = mt_rand(1000,9999);
        $has_code = Customer::where('code',$code)->count();
        while ($has_code) 
        {
            $code = mt_rand(1000,9999);
            $has_code = Customer::where('code',$code)->count();
                   
        }

        $message = __('lang.send_you_code_on_phone') .' " '.$request->phone . ' ". '. __('lang.please_verify').' .';

        $data = ['code'=>$code];

        if (empty($seller->phone)) 
        {
            $data['phone'] = $request->phone;
        }


        $seller->update($data);

        $data['phone'] = $request->phone;

        Notification::send($seller, new LoginPhoneCode($code,$request->phone));

        $data['code'] = 1;
        return $this->apisuccess($data,$message);
 
        // return $this->apierror('server error',401);
    }

    public function verifyphonecode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone',
            'code' => 'required|digits:4',//|min:6
        ]);
        
        if ($validator->fails()) 
        {
            return $this->apierror($validator->errors(),422);
        }

        $phone = $request->phone;
        $code = $request->code;

        $seller = Customer::where('phone',$request->phone)->first();

        if ($seller && $seller->code===$code  && $seller->id==Auth::guard('customer')->user()->id) 
        {
            $seller->update(['code'=>null,'phone_verified_at'=>date("Y-m-d H:i:s")]);

            return $this->apisuccess(null);
        }

        $error = __('lang.your_code_is_invalid');
        return $this->apierror($error,422);
       
    }

    // send email verify code
    public function sendemail(Request $request)
    {
        $seller = Auth::guard('customer')->user(); 
        
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email|unique:customers,email,'.$seller->id,
        ]);

        if ($validator->fails()) 
        {
            return $this->apierror($validator->errors()->first(),422);
        }

        
        
        $code = mt_rand(1000,9999);
        $has_code = Customer::where('code',$code)->count();
        while ($has_code) 
        {
            $code = mt_rand(1000,9999);
            $has_code = Customer::where('code',$code)->count();
                   
        }
        $data = ['code'=>$code];

        if (empty($seller->email)) 
        {
            $data['email'] = $request->email;
        }


        $seller->update($data);

        $message = __('lang.send_you_code_on_email').' " '.$request->email . ' ". '.__('lang.please_verify').'.';

        $data['email'] = $request->email;

        Notification::send($seller, new LoginEmailCode($code));
         $data['code'] = 1;
        return $this->apisuccess($data,$message);
            
   
        // return $this->apierror('server error',401);
    }
    public function verifyemailcode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
            'code' => 'required|digits:4',//|min:6
        ]);
        
        if ($validator->fails()) 
        {
            return $this->apierror($validator->errors(),422);
        }

        $email = $request->email;
        $code = $request->code;

        $seller = Customer::where('email',$request->email)->first();

        if ($seller && $seller->code===$code && $seller->id==Auth::guard('customer')->user()->id) 
        {
            $seller->update(['code'=>null,'email_verified_at'=>date("Y-m-d H:i:s")]);

            return $this->apisuccess(null);
        }

        $error = __('lang.your_code_is_invalid');
        return $this->apierror($error,422);
       
    }
    protected function apisuccess($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> 'Success', 
            'message' => $message, 
            'data' => $data
        ], $code);
    }

    protected function apierror($message = null, $code=422)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
