<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Helper\Functions;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Siteconfig;
use App\Rules\ReCaptchaRule;
use App\Traits\ApiResponser;
use App\Traits\WebResponser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Notification;
use Session;
use URL;
use Validator;
// use Illuminate\Auth\Events\Failed;
// use Illuminate\Auth\Events\Login;
// use Illuminate\Auth\Events\Logout;
class LoginController extends Controller
{

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
     
    use AuthenticatesUsers, WebResponser;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    protected $username = 'email';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
        // dd(auth('customer')->user());
        if (Auth::guard('customer')->check()) 
        {
            return redirect()->route('customer.account');
        }

         // $this->service = $service;

    }
    protected function sendLoginResponse(Request $request)
    {

        $request->session()->regenerate();
        
        $this->clearLoginAttempts($request);
        // $roles = Auth::guard('customer')->user()->roles()->where('role_id',1)->get();
        return redirect()->intended(route('customer.account'));
        // $data['url'] = redirect()->intended(route('profile'))->getTargetUrl();
        
        // return $this->success($data,'');
    }

    public function signup(Request $request)
    {
        return view('customer.auth.register');
    }

    protected function credentials(Request $request)
    {
        return [$this->username()=>$request->{$this->username()}, 'password'=>$request->password, 'activated'=>'1', 'blocked'=>'0'];
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
            return $this->error($validator->errors(),422);
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
                $message = __('lang.send_you_code_on_email').' " '.$customer->email . ' ". '.__('lang.please_verify').'.';

                Notification::send($customer, new LoginEmailCode($code));
 
                $this->incrementLoginAttempts($request);
                $data['code'] = 1;
                $data['email'] = $customer->email;
                return $this->success($data,$message);

            }
            
        }else
        {
            $code = $this->code();
            $customer = $this->created($request,$code);
            $message = __('lang.send_you_code_on_email').' " '.$request->email . ' ". '.__('lang.please_verify').'.';

            $data['email'] = $customer->email;

            Notification::send($customer, new LoginEmailCode($code));
            $this->incrementLoginAttempts($request);
            $data['code'] = 1;
            return $this->success($data,$message);
 
        }
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
        // $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',//|min:6
        ]);

        if ($validator->fails()) 
        {

            $this->incrementLoginAttempts($request);
            return $this->error($validator->errors(),422);
        }

        if ($this->attemptLogin($request)) 
        {
            event(new Login('customer',auth('customer')->user(),0));
            return $this->sendLoginResponse($request);
        }else{

            event(new Failed('customer','',$this->credentials($request)));
            $this->incrementLoginAttempts($request);

            return $this->error(__('lang.incorrect_email_or_passowrd'),401);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        session(['customer'=>$this->ValidEmail($request)]);
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
    public function before_login(Request $request)
    {
        $request->validate([
            $this->username() => 'required|email',
            'password' => 'required',
            'recaptcha_token' => ['required', new   ReCaptchaRule($request->recaptcha_token)]
        ]);
        // $this->validateBeforeLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

        /*$validator = Validator::make($request->all(), [
            $this->username() => 'required|email',
            'password' => 'required',
        ]);*/

         /*if ($validator->fails()) 
        {
            $this->incrementLoginAttempts($request);
            // return $this->error($validator->errors(),422);
            return $this->error($validator->errors());
        }*/

        /*
        if ($customer = $this->ValidEmail($request)) 
        {
            if ($customer->blocked==1) 
            {
                $message = __('lang.is_blocked_by_admin');
                // return $this->error($message,401);
                return $this->error($message);
            }elseif ($customer->activated==0) 
            {
                $code = $this->code();
                $this->updateCode($customer,$code);
                $message = __('lang.send_you_code_on_email').' " '.$request->email . ' ". '.__('lang.please_verify').'.';

                Notification::send($customer, new LoginEmailCode($code));
 
                $this->incrementLoginAttempts($request);
                $data['code'] = 1;
                $data['email'] = $customer->email;
                return $this->success($data,$message);

            }elseif ($customer->activated==1) 
            {
                // $record = $this->service->resource($customer);
                $record['email'] = $customer->email;
                $record['avatar'] = $customer->getAvatar();
                $record['name'] = $customer->name;

                $this->clearLoginAttempts($request);
                return $this->success($record,'Need your passwowrd');
                // return redirect()->route('customer.auth.emailpassowrd')->withInput(request()->all());
            }
            elseif ($customer->activated==1) 
            {
                session(['customer' => $customer->only('id','name','email')]);
                return redirect()->route('customer.auth.emailpassowrd')->withInput(request()->all());
            }
        }else
        {
            $code = $this->code();
            $customer = $this->created($request,$code);
            $message = __('lang.send_you_code_on_email').' " '.$request->email . ' ". '.__('lang.please_verify').'.';

            $data['email'] = $customer->email;

            Notification::send($customer, new LoginEmailCode($code));
            $this->incrementLoginAttempts($request);
            $data['code'] = 1;
            return $this->success($data,$message);

            /*$code = $this->code();
            $customer = $this->created($request,$code);
            $message = 'We have send you a code in you email " '.$request->email . ' ". Please verify.';
            session()->flash('message', $message);
            // $customer->notify(new LoginEmailCode($code));
            Notification::send($customer, new LoginEmailCode($code));
            $this->incrementLoginAttempts($request);
            return redirect()->route('customer.auth.emailcode')->withInput(request()->all())->with(['customer' => $customer->only('id','name','email')]);*/
        // }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        /*$this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);*/
    }

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
            return $this->error($validator->errors(),422);
        }

        $email = $request->email;
        $code = $request->code;

        $customer = $this->ValidEmail($request);
        if ($customer && $customer->code===$code) 
        {
            $message = __('lang.please_set_your_password_to_accesss_account');
            // $request->merge(['code'=>$code]);
            // $record = $this->service->resource($customer);
            $record['name'] = $customer->name;
            $record['email'] = $customer->email;
            $record['code'] = $customer->code;
            $record['avatar'] = $customer->getAvatar();
            return $this->success($record,$message);
            // return redirect()->route('customer.auth.setemailpassword')->withInput(request()->all())->with(['code' => $customer->code]);
        }else
        {
            $this->incrementLoginAttempts($request);
            $error = __('lang.your_code_is_invalid');
            return $this->error($error,422);
        }

        /*
        $email = $request->email;
        $code1 = $request->code_a;
        $code2 = $request->code_b;
        $code3 = $request->code_c;
        $code4 = $request->code_d;
        $code = $code1.$code2.$code3.$code4;
        $customer = Customer::where('email',$email)->first();
        if ($customer && $customer->code===$code) 
        {
            $request->merge(['code'=>$code]);
            return redirect()->route('customer.auth.setemailpassword')->withInput(request()->all())->with(['code' => $customer->code]);
        }else
        {
            $this->incrementLoginAttempts($request);
            return redirect()->route('customer.auth.emailcode')->withInput(request()->all())->with(['invalidcode' => __('lang.your_code_is_invalid'),'customer'=>$customer]);
        }*/
       
    }

    public function verifyphonecode(Request $request)
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
            // $record = $this->service->resource($customer);
            $record['name'] = $customer->name; 
            $record['phone'] = $customer->phone; 
            $record['code'] = $customer->code; 
            $record['avatar'] = $customer->getAvatar(); 
            return $this->success($record,$message);
            // return redirect()->route('customer.auth.setemailpassword')->withInput(request()->all())->with(['code' => $customer->code]);
        }else
        {
            $this->incrementLoginAttempts($request);
            $error = __('lang.your_code_is_invalid');
            return $this->error($error,422);
        }

        /*
        $email = $request->email;
        $code1 = $request->code_a;
        $code2 = $request->code_b;
        $code3 = $request->code_c;
        $code4 = $request->code_d;
        $code = $code1.$code2.$code3.$code4;
        $customer = Customer::where('email',$email)->first();
        if ($customer && $customer->code===$code) 
        {
            $request->merge(['code'=>$code]);
            return redirect()->route('customer.auth.setemailpassword')->withInput(request()->all())->with(['code' => $customer->code]);
        }else
        {
            $this->incrementLoginAttempts($request);
            return redirect()->route('customer.auth.emailcode')->withInput(request()->all())->with(['invalidcode' => __('lang.your_code_is_invalid'),'customer'=>$customer]);
        }*/
       
    }
    

    public function setEmailPassword(Request $request)
    {
        // dd($customer = session('customer'));
        
        $request->validate([
            'email' => 'required|string|email|max:255|exists:customers,email',
            'password' => 'required|string|min:8',
            'code' => 'required|digits:4',
        ]);
        
        
        $customer = Customer::where('email',$request->email)->where('code',$request->code)->where('blocked',0)->first();
        // dd($customer);
        if ($customer) 
        {
            
            $uniqid = $this->findUniqeID();
            $customer->update(['password'=>Hash::make($request->password),'code'=>null,'activated'=>1,'social_type'=>'email','email_verified_at'=>date("Y-m-d H:i:s"),'profile'=>$uniqid]);

            if (session('agent_code')) 
            {
                $site_conf = Siteconfig::find(1);
                $to = $site_conf->email;
                $msg = 'Agent:'.session('agent_code').' has signed up ' .$customer->name . '(email:'.$customer->email.')';
                \Mail::raw($msg, function ($message) use ($msg,$to){
                      $message->to($to)
                        ->subject('Signup From Agent: '.session('agent_code'))
                        ->setBody($msg, 'text/html');
                    });; 
                $request->session()->forget('agent_code');
            }
            // $token = JWTAuth::fromUser($finduser);
            return $this->login($request);
            // return $this->success($token,'Login successfully');
        }else{

            $this->incrementLoginAttempts($request);
            return $this->error(__('lang.your_code_is_invalid'),401);
        }

        /*$request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        
        $customer = Customer::where('email',$request->email)->where('code',$request->code)->first();
        if ($customer) 
        {
            
            $uniqid = $this->findUniqeID();
            $customer->update(['password'=>Hash::make($request->password),'code'=>null,'activated'=>1,'email_verified_at'=>date("Y-m-d H:i:s"),'profile'=>$uniqid]);

            return $this->login($request);
        }else{

            return redirect()->route('customer.auth.setemailpassword')->withInput(request()->all())->with(['message' => 'Something goes wrong. Please try again!']);
        }*/

    }

    public function setPhonePassword(Request $request)
    {
        // dd($customer = session('customer'));
        
        $request->validate([
            'phone' => 'required|string|max:255|exists:customers,phone',
            'password' => 'required|string|min:8',
            'code' => 'required|digits:4',
        ]);
        
        
        $customer = Customer::where('phone',$request->phone)->where('code',$request->code)->where('blocked',0)->first();
        // dd($customer);
        if ($customer) 
        {
            
            $uniqid = $this->findUniqeID();
            $customer->update(['password'=>Hash::make($request->password),'code'=>null,'activated'=>1,'social_type'=>'phone','phone_verified_at'=>date("Y-m-d H:i:s"),'profile'=>$uniqid]);

            if (session('agent_code')) 
            {
                $site_conf = Siteconfig::find(1);
                $to = $site_conf->email;
                $msg = 'Agent:'.session('agent_code').' has signed up ' .$customer->name . '(Phone:'.$customer->phone.')';
                \Mail::raw($msg, function ($message) use ($msg,$to){
                      $message->to($to)
                        ->subject('Signup From Agent: '.session('agent_code'))
                        ->setBody($msg, 'text/html');
                    });; 
                $request->session()->forget('agent_code');
            }

            // $token = JWTAuth::fromUser($finduser);
            return $this->loginwithphone($request);
            // return $this->success($token,'Login successfully');
        }else{

            $this->incrementLoginAttempts($request);
            return $this->error(__('lang.your_code_is_invalid'),401);
        }

        /*$request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        
        $customer = Customer::where('email',$request->email)->where('code',$request->code)->first();
        if ($customer) 
        {
            
            $uniqid = $this->findUniqeID();
            $customer->update(['password'=>Hash::make($request->password),'code'=>null,'activated'=>1,'email_verified_at'=>date("Y-m-d H:i:s"),'profile'=>$uniqid]);

            return $this->login($request);
        }else{

            return redirect()->route('customer.auth.setemailpassword')->withInput(request()->all())->with(['message' => 'Something goes wrong. Please try again!']);
        }*/

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
        
        $getname = explode('@', $request->email);
        $name = array_key_exists(0, $getname) ? $getname[0] : '';
        return Customer::create(['email'=>$request->email,'code'=>$code,'name'=>$name,'password' => Hash::make(sha1(mt_rand(999,99999)))]);
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
    protected function validateLogin(Request $request) // not used
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
    protected function validateBeforeLogin(Request $request) // not used
    {
        $request->validate([
            $this->username() => 'required|email',
        ]);
    }

    
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
        // return $this->username;
        return 'email';
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        // dd('customer/logout');
        event(new Logout('customer',Auth::guard('customer')->user()));
    }

/* start login with phone */
    
    protected function created_for_phone(Request $request,$code)
    {
        $name = $request->phone;
        return Customer::create(['phone'=>$request->phone,'code'=>$code,'name'=>$name,'password' => Hash::make(sha1(mt_rand(999,99999)))]);
    }

    protected function ValidPhone(Request $request)
    {
        return Customer::where('phone',$request->phone)->first(); 
    }

    protected function attemptPhoneLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->phonecredentials($request), $request->filled('remember')
        );
    }
     
    protected function phonecredentials(Request $request)
    {
        return ['phone'=>$request->phone, 'password'=>$request->password, 'activated'=>'1', 'blocked'=>'0'];
    }
 
    /* end login with phone */

    /**
     * Show the application's 
     *
     * @return \Illuminate\View\View
     */
    public function showVerifyCodeForm(Request $request)
    {
        
        $customer = session('customer');
        if (empty($customer)) 
        {
            return redirect()->route('customer.auth.email');
        }
        return view('customer.auth.email-code',compact('customer'));
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showVerifyPasswordForm(Request $request)
    {
        // dd($request->all());
        $customer = session('customer');
        $email = $customer ? $customer['email'] : $request->email;
        return view('customer.auth.verifypassword',compact('email'));
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showAuthOptions()
    {
        return view('customer.auth.loginoptions');
    }
    public function showEmailPasswordForm(Request $request)
    {
        $email = $request->email;
        $code = $request->code;
        return view('customer.auth.set-password',compact('email','code'));
    }
}
