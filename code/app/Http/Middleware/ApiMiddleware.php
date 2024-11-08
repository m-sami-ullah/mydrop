<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use App\Models\User;
use JWTAuth;

use App\Traits\ApiResponser;

class ApiMiddleware
{
    use ApiResponser;

    public function handle($request, Closure $next, $guard = null)
    {
        
        // get token from request header
        $token = $request->bearerToken();
        if(!$token) {
          
          // Unauthorized response if token not there
            return $this->error('Provided token is invalid',401);
        }
        
        try {
          
            // $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            $user = JWTAuth::setToken($token)->toUser();
            // dd($user);
            $apy = JWTAuth::getPayload($token)->toArray();
            // dd($apy['campus']);
        } catch(ExpiredException $e) {
            
            return $this->error('Provided token is expired.',401);
          
        } catch(Exception $e) 
        {
            return $this->error('Provided token is expired',401);//'An error while decoding token.'
 
        }
      
        // Now let's put the user in the request class so that you can grab it from there
        if(!empty($user))
        {
          
            $request->merge(['auth'=>$user->id]);

            
        }else{
            
            return $this->error('Provided token is invalid.',401);
        }
        
        return $next($request);
    }
}