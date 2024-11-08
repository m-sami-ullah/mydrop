<?php

namespace App\Http\Controllers\api\Auth;

use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\Functions;
use App\Notifications\LoginEmailCode;
use App\Notifications\LoginPhoneCode;
use App\Services\CustomerService;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Notification;
use Mail;
use URL;
use Validator;
use JWTAuth;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
class LoginController extends ApiController
{
    use AuthenticatesUsers;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    protected $service;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

     
    /*public function social_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'name' => 'required',
            // 'url' => 'required|url',
            'profileid' => 'required',
            'social' => 'required',
            ]);
            
        if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors()->first(),422);
        }

        try {

            if ($customer = $this->ValidEmail($request)) 
            {
                $data['user'] = $customer;

            }else
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    // 'url' => 'required|url',
                    'profileid' => 'required|unique:customers,profile',
                    'social' => 'required',
                    ]);
                    
                if ($validator->fails()) 
                {
                    $this->incrementLoginAttempts($request);
                    return $this->error($validator->errors()->first(),422);
                }

                // $social_type = $request->social == 'facebook' ? 'facebook':'google';
                $social_types = ['facebook','google','apple'];

                $social_type = in_array($request->social, $social_types) ? $request->social:'google';

                $customer_data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'profile'=> $request->profileid,
                    'activated'=>1,
                    'email_verified_at'=>date("Y-m-d H:i:s"),
                    'social_id'=> $request->profileid,
                    'social_type'=> $social_type,
                    'password' => Hash::make(sha1(mt_rand(999,99999)))
                ];

                if ($request->has('url')) 
                {
                    $disk = \Storage::disk('local');

                    $fileContents = file_get_contents(urldecode($request->url));

                    $filename = $request->profileid .'.jpg';
                    $file = '/temp/' . $filename;
                    
                    if(file_exists($file))
                    {
                        $filename = $request->profileid . mt_rand(99,9999) .'.jpg';
                        $disk->put($file,$fileContents);  
                        $filepath = 'avatar' . '/' .$filename;
                        if(!file_exists($filepath))
                        {
                            $disk->move($file,$filepath);    
                        }
                    
                    }else{
                        $filename = $request->profileid .'.jpg';
                        $disk->put($file,$fileContents);  
                        $filepath = 'avatar' . '/' .$filename;
                        if(!file_exists($filepath))
                        {
                            $disk->move($file,$filepath);    
                        }
                    }
                    
                     

                    $customer_data['avatar'] = $filename;
                }

                $customer = Customer::create($customer_data);
                $data['user'] = $customer   = $this->ValidEmail($request);
            }


            $token= JWTAuth::fromUser($customer);

            $data['access_token'] = $token;
            $data['token_type'] = 'bearer';
            $data['expires_in'] = auth('api')->factory()->getTTL() * 60;

            $data['user'] = $this->service->resource($customer,'SellerSelf');
            return $this->success($data,'User login successfully');


        } catch (Exception $e) 
        {
            return $this->error('Something goes wrong',401);;
        }
    }*/ 
     
    
    protected function credentials(Request $request)
    {
        return ['email'=>$request->{$this->username()}, 'password'=>$request->password, 'activated'=>'1', 'blocked'=>'0'];
    }

    

    public function forgot_email_password(Request $request)
    {
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        } 

        $validator = Validator::make($request->all(), [
            $this->username() => 'required|email',
        ]);

         if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors()->first(),422);
        } 

        if ($customer = $this->ValidEmail($request)) 
        {
            if ($customer->blocked==1) 
            {
                $message = __('lang.is_blocked_by_admin');
                return $this->error($message,401);
            }elseif ($customer->activated==0 || $customer->activated==1) 
            {
                $code = $this->code();
                $this->updateCode($customer,$code);
                $message = __('lang.send_you_code_on_email').' '.$request->email . ' '.__('lang.please_verify').'.';

                Notification::send($customer, new LoginEmailCode($code));
 
                $this->incrementLoginAttempts($request);

                return $this->success(null,$message);

            }

        }else
        {
            $code = $this->code();
            $customer = $this->created($request,$code);
            $message = __('lang.send_you_code_on_email').' '.$request->email . ' '.__('lang.please_verify').'.';

            Notification::send($customer, new LoginEmailCode($code));
            
 
            $this->incrementLoginAttempts($request);

            return $this->success(null,$message);
        }

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
 
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
 
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',//|min:6
        ]);

        if ($validator->fails()) 
        {

            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors()->first(),422);
        }

        if (! $token = auth('api')->attempt($this->credentials($request))) 
        {
            event(new Failed('api','',$this->credentials($request)));
            $this->incrementLoginAttempts($request);
            return $this->error(__('lang.incorrect_email_or_passowrd'),401);
        }

        event(new Login('api',auth('api')->user(),0));

        return $this->createNewToken($token);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register_email(Request $request)
    {
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        

        // dd('--');
        $validator = Validator::make($request->all(), [
            $this->username() => 'required|email|unique:customers',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
        ]);

         if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors()->first(),422);
        }


            $code = $this->code();
            $customer = $this->created($request,$code);
            $message = __('lang.send_you_code_on_email').' '.$customer->email . ' '.__('lang.please_verify').'.';

            Notification::send($customer, new LoginEmailCode($code));
            // $this->log($code);
 
            $this->incrementLoginAttempts($request);

            return $this->success(null,$message);
            // return redirect()->route('seller.auth.emailcode')->withInput(request()->all())->with(['seller' => $customer->only('id','name','email')]);

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        // $this->incrementLoginAttempts($request);

        // return $this->sendFailedLoginResponse($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   /* public function before_login_phone(Request $request)
    {
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);
        
         if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors(),422);
        }
        
        // $this->validateBeforeLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        
        // if (method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }
        
        if ($customer = $this->ValidPhone($request)) 
        {
            if ($customer->blocked==1) 
            {
                $message = __('lang.is_blocked_by_admin');
                return $this->error($message,401);
            }elseif ($customer->activated==0) 
            {
                
               
                $code = $this->code();
                $this->updateCode($customer,$code);
                $message = __('lang.send_you_code_on_phone').' '.$customer->phone . ' '.__('lang.please_verify').'.';
                
                
                
                Notification::send($customer, new LoginPhoneCode($code,$customer->phone));
                 
                $this->incrementLoginAttempts($request);

                return $this->success(null,$message);
                // return redirect()->route('seller.auth.emailcode')->withInput(request()->all());

            }elseif ($customer->activated==1) 
            {
                $record = $this->service->resource($customer,'SellerSelf');
 
                $this->clearLoginAttempts($request);
                return $this->success($record,'Need your passwowrd');
                // return redirect()->route('seller.auth.emailpassowrd')->withInput(request()->all());
            }
        }else
        {
            $code = $this->code();
            $customer = $this->createdFromPhone($request,$code);
            $message = __('lang.send_you_code_on_phone').' '.$customer->phone . ' '.__('lang.please_verify').'.';

            Notification::send($customer, new LoginPhoneCode($code,$customer->phone));
            
 
            $this->incrementLoginAttempts($request);

            return $this->success(null,$message);
            // return redirect()->route('seller.auth.emailcode')->withInput(request()->all())->with(['seller' => $customer->only('id','name','email')]);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        // $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
*/

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /*public function login_phone(Request $request)
    {
 
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
 
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|string',//|min:6
        ]);

        if ($validator->fails()) 
        {

            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors(),422);
        }

        if (! $token = auth('api')->attempt($this->credentials_phone($request))) 
        {
            event(new Failed('api','',$this->credentials_phone($request)));
            $this->incrementLoginAttempts($request);
            return $this->error(__('lang.incorrect_phone_or_passowrd'),401);
        }

        event(new Login('api',auth('api')->user(),0));

        return $this->createNewToken($token);
    }
    
    public function setphonePassword(Request $request)
    {
        // dd($customer = session('seller'));
        // dd('seller---');
        $request->validate([
            'phone' => 'required|max:255|exists:customers,phone',
            'password' => 'required|string|min:8',
            'code' => 'required|digits:4',
        ]);
        
        
        $customer = Customer::where('phone',$request->phone)->where('code',$request->code)->first();
        // dd($customer);
        if ($customer) 
        {
            
            $uniqid = $this->findUniqeID();
            $customer->update(['password'=>Hash::make($request->password),'code'=>null,'activated'=>1,'phone_verified_at'=>date("Y-m-d H:i:s"),'profile'=>$uniqid]);


            // $token = JWTAuth::fromUser($finduser);
            return $this->login_phone($request);
            // return $this->success($token,'Login successfully');
        }else{

            $this->incrementLoginAttempts($request);
            $error = __('lang.your_code_is_invalid');
            return $this->error($error,401);
        }
    }

    public function forgot_phone_password(Request $request)
    {
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        } 

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

         if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors(),422);
        } 

        if ($customer = $this->ValidPhone($request)) 
        {
            if ($customer->blocked==1) 
            {
                $message = __('lang.is_blocked_by_admin');
                return $this->error($message,401);
            }elseif ($customer->activated==0 || $customer->activated==1) 
            {
                $code = $this->code();
                $this->updateCode($customer,$code);
                $message = __('lang.send_you_code_on_phone').' '.$request->phone . ' '.__('lang.please_verify').'.';

                Notification::send($customer, new LoginPhoneCode($code,$customer->phone));
 
                $this->incrementLoginAttempts($request);

                return $this->success(null,$message);

            }

        }else
        {
            $code = $this->code();
            $customer = $this->createdFromPhone($request,$code);
            $message = __('lang.send_you_code_on_phone').' '.$request->phone . ' '.__('lang.please_verify').'.';

            Notification::send($customer, new LoginPhoneCode($code,$customer->phone));
            
 
            $this->incrementLoginAttempts($request);

            return $this->success(null,$message);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials_phone(Request $request)
    {
        return ['phone'=>$request->phone, 'password'=>$request->password, 'activated'=>'1', 'blocked'=>'0'];
    }
   
    protected function ValidPhone(Request $request)
    {
        return Customer::where('phone',$request->phone)->first(); 
    }

    public function verifycode_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone',
            'code' => 'required|digits:4',//|min:6
        ]);
        
        if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors(),422);
        }

        $phone = $request->phone;
        $code = $request->code;

        $customer = $this->ValidPhone($request);
        if ($customer && $customer->code===$code) 
        {
            $message = __('lang.please_set_your_password_to_accesss_account');
            // $request->merge(['code'=>$code]);
            $record = $this->service->resource($customer,'SellerSelf');
            return $this->success($record,$message);
            // return redirect()->route('seller.auth.setemailpassword')->withInput(request()->all())->with(['code' => $customer->code]);
        }else
        {
            $this->incrementLoginAttempts($request);
            $error = __('lang.your_code_is_invalid');
            return $this->error($error,422);
        }
       
    }
    protected function createdFromPhone(Request $request,$code)
    {
        
        $name = $request->phone;
        return Customer::create(['phone'=>$request->phone,'code'=>$code,'name'=>$name,'password' => Hash::make(sha1(mt_rand(999,99999)))]);
    }*/

    protected function ValidEmail(Request $request)
    {
        return Customer::where('email',$request->email)->first(); 
    }
    public function verifycode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
            'code' => 'required|digits:4',//|min:6
        ]);
        
        if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors()->first(),422);
        }

        $customer = Customer::where('email',$request->email)->where('code',$request->code)->first();

        if ($customer) 
        {
            $customer->update(['code'=>null,'activated'=>1,'status'=>1,'email_verified_at'=>date("Y-m-d H:i:s")]);
            return $this->success(null,'Your account verified successfully');
        }else{
            $this->incrementLoginAttempts($request);
            $error = __('lang.your_code_is_invalid');
            return $this->error($error,401);
        }

    }
    // public function showEmailPasswordForm(Request $request)
    // {
    //     $email = $request->email;
    //     $code = $request->code;
    //     return view('seller.auth.set-password',compact('email','code'));
    // }
    public function setemailpassword(Request $request)
    {
        // dd($customer = session('seller'));
        // dd('seller---');
        $request->validate([
            'email' => 'required|string|email|max:255|exists:customers,email',
            'password' => 'required|string|min:8',
            'code' => 'required|digits:4',
        ]);
        
        
        $customer = Customer::where('email',$request->email)->where('code',$request->code)->first();
        // dd($customer);
        if ($customer) 
        {
            
            $uniqid = $this->findUniqeID();
            $customer->update(['password'=>Hash::make($request->password),'code'=>null,'activated'=>1,'email_verified_at'=>date("Y-m-d H:i:s"),'profile'=>$uniqid]);


            // $token = JWTAuth::fromUser($finduser);
            return $this->login($request);
            // return $this->success($token,'Login successfully');
        }else{

            $this->incrementLoginAttempts($request);
            $error = __('lang.your_code_is_invalid');
            return $this->error($error,401);
        }

    }

    
    protected function findUniqeID()
    {
        $uniqid = uniqid();
        $isUnique = Customer::where('profile',$uniqid)->count(); 
        $i = 0;
        while ($isUnique && $i<10)  
        {
            $uniqid = uniqid(); 
            $isUnique = Customer::where('profile',$uniqid)->count();
                
        }
        return $uniqid;

    }   
    public function updateCode($customer,$code)
    {
        return $customer->update(['code'=>$code]);
    }
    protected function created(Request $request,$code)
    {
        // dd($request->password);
        // $getname = explode('@', $request->email);
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $password = $request->password;
        return Customer::create(['email'=>$request->email,'code'=>$code,'firstname'=>$firstname,'lastname'=>$lastname,'password' => bcrypt($password) ]);
    }

    
    public function code()
    {
        $code = mt_rand(1000,9999);
        $has_code = Customer::where('code',$code)->count();
        while ($has_code) 
        {
            $code = mt_rand(1000,9999);
            $has_code = Customer::where('code',$code)->count();
                   
        }
        return $code;
    }
    /**
     * Validate the user login request.
        
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|email',
            'password' => 'required|string',
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function validateBeforeLogin(Request $request)
    // {
    //     $request->validate([
    //         $this->username() => 'required|email',
    //     ]);
    // }
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // protected function credentials(Request $request)
    // {
    //     return $request->only($this->username(), 'password');
    // }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('api');
    }

    public function refresh()
    {
        try {

            return $this->respondWithToken(auth()->guard('api')->refresh());
            
        }catch(TokenBlacklistedException $e) {
        
        return $this->error('Token has been blacklisted',403);
          
        } catch(Exception $e) 
        {
            return $this->error($e->getMessage(),403);//'An error while decoding token.'
 
        }
    }
    
    protected function respondWithToken($token)
    {
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            // 'user' => auth('api')->user() 
        ]);
         
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function createNewToken($token){
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            // 'user' => auth('api')->user() 
        ]);
        // return response()->json();
    }
}
