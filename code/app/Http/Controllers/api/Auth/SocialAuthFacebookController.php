<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
// use Auth;
use Exception;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;
use Illuminate\Http\UploadedFile;
use Storage;
use File;
use JWTAuth;
class SocialAuthFacebookController extends Controller
{
  use ApiResponser;
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
      // dd('==/');
      $url = Socialite::with('facebook')->stateless()->redirect()->getTargetUrl();
        return $this->success(['url'=>$url]);
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
       try {
     
            $user = Socialite::with('facebook')->stateless()->user();
            // dd($user);
            // $user = Socialite::driver('facebook')->user();
       
            $finduser = Seller::where('email', $user->email)->first();
            
            
            if(!$finduser)
            {
                $fileContents = file_get_contents($user->getAvatar());
                $filename = $user->id .'.jpg';
                $file = '/tmp/' . $filename;
                file_put_contents($file, $fileContents);
                $uploaded_file = new UploadedFile($file, $filename);
                $disk = Storage::disk('local'); 
                $filepath = 'avatar' . '/' .$filename ;

                $disk->put($filepath, File::get($file));

                $finduser = Seller::create([
                    'name' => $user->name,
                    'avatar' => $filename,
                    'email' => $user->email,
                    'profile'=> $user->id,
                    'activated'=>1,
                    'email_verified_at'=>date("Y-m-d H:i:s"),
                    'social_id'=> $user->id,
                    'social_type'=> 'facebook',
                    'password' => Hash::make(sha1(mt_rand(999,99999)))
                ]);
                
                // Auth::guard('oui')->login($newUser);
      
                // return redirect()->intended(route('profile'));
            }
          $token = JWTAuth::fromUser($finduser);

          return $this->success($token,'Login successfully');
     
        } catch (Exception $e) 
        {
          // dd($e);
            return $this->error('Something goes wrong',401);;
        }
    }
}
