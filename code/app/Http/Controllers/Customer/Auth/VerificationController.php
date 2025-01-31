<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    public function redirectTo()
    {
        return route('customer.account');
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customers');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return auth('customer')->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('customer.auth.verify');
    }

     public function verify(Request $request)
    {
        // dd($request->user());
        $user = auth('customer')->user();
        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }
        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new Response('', 204)
                        : redirect($this->redirectPath());
        }
        
        self::innerVerify($user);

        // dd($response = $this->verified($request));

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 204)
                    : redirect($this->redirectPath())->with('verified', true);
    }

    public static function innerVerify($user)
    {
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        // $user->update(['status'=>2]);
    }

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request)
    {
        //$user->active = true;
        //$request->user()->update();
        return $request->wantsJson()
                    ? new Response('', 204)
                    : redirect($this->redirectPath())->with('verified', true);
    }

    public function resend(Request $request)
    {
        $user = auth('customer')->user();
        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $user->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
}
