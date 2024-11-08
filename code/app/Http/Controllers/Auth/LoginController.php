<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Functions;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }
    protected function sendLoginResponse(Request $request)
    {

        $request->session()->regenerate();
        
        $this->clearLoginAttempts($request);
         // event(new Login('web',auth('web')->user(),0));
        return redirect()->intended(route('admindashboard'));
        
    }
    
    protected function credentials(Request $request)
    {
        return ['email'=>$request->{$this->username()}, 'password'=>$request->password, 'activated'=>'1'];
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
         event(new Logout('web',Auth::guard('web')->user()));
    }
}
