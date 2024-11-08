<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Storage;
use File;
use Session;

class SocialAuthGoogleController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
       try {
        
            $user = Socialite::driver('google')->user();
        
            $finduser = Seller::where('email', $user->email)->first();
             

            if($finduser)
            {
                Auth::guard('oui')->login($finduser);
                return redirect()->intended(route('profile'));
            }else{

                $url = $user->avatar;
                $info = pathinfo($url);
                
                $contents = file_get_contents($url);
                $filename = $user->id .'.jpg';
                $file = '/tmp/' . $filename;
                file_put_contents($file, $contents);
                $uploaded_file = new UploadedFile($file, $filename);
                $disk = Storage::disk('local'); 
                $filepath = 'avatar' . '/' .$filename ;

                $disk->put($filepath, File::get($file));                            
                

                $newUser = Seller::create([
                    'name' => $user->name,
                    'avatar' => $filename,
                    'email' => $user->email,
                    'profile'=> $user->id,
                    'activated'=>1,
                    'email_verified_at'=>date("Y-m-d H:i:s"),
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => Hash::make(sha1(mt_rand(999,99999)))
                ]);
     
                Auth::guard('oui')->login($newUser);
                
                // $url = $user->avatar;
                // $info = pathinfo($url);
                
                // $contents = file_get_contents($url);
                // $file = '/tmp/' . $info['basename'] .'.jpg';
                // file_put_contents($file, $contents);
                // $uploaded_file = new UploadedFile($file, $info['basename']);
                // $disk = Storage::disk('public'); 
                // $filepath = 'user' . '/' . $info['basename'] .'.jpg';

                // $disk->put($filepath, File::get($file));
                return redirect()->intended(route('profile'));
            }
     
        } catch (Exception $e) 
        {
            return redirect()->route('seller.auth')->withInput(request()->all())->with(['error' => $e->getMessage()]);
        }
    }
}
