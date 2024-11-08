<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use App\Models\User;
use JWTAuth;
use App;

use App\Traits\ApiResponser;
// use Firebase\JWT\JWT;
// use Firebase\JWT\ExpiredException;
class AuthMiddleware
{
    use ApiResponser;

    public function handle($request, Closure $next, $guard = null)
    {
        
        // get token from request header
        $token = $request->bearerToken();

        if(!$token) {
          
          // Unauthorized response if token not there
            return $this->error('Token required.',403);
        }
        


        /* try {
        // attempt to verify the credentials and create a token for the user
        $token = JWTAuth::setToken($token);
        $apy = JWTAuth::getPayload($token)->toArray();

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['Token is expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }*/


        try {
          
            // $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            // dd($credentials);
            auth()->shouldUse('api');
            $user = JWTAuth::setToken($token)->toUser();

            // dd($user);
            $apy = JWTAuth::getPayload($token)->toArray();
            // dd($apy);
            // dd($apy['campus']);
        } catch(ExpiredException $e) {
            
            return $this->error('Token has expired.',403);
          
        } catch(Exception $e) 
        {
            return $this->error($e->getMessage(),403);//'An error while decoding token.'
 
        }
      
        // $user = Users::find($credentials->sub);
        // echo '<pre>';print_r($user);exit;
        // Now let's put the user in the request class so that you can grab it from there
        if(!empty($user))
        {
          
            $request->merge(['auth'=>$user->id]);
             
        }else{
            
            return $this->error('Token is invalid.',403);
        }
        
        return $next($request);
    }
}