<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

use App\Models\Active_login;
use App\Models\Loginhistory;

class LogSuccessLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        if (!$event->user) 
        {
            abort(404);
        }
        $id = ($event->user)?$event->user->id:NULL;

        $data = array(
                    'token'     => $id,
                    'details'   => serialize($this->request->server()),
                    'ip'        => $this->request->server('REMOTE_ADDR')
                    );
        
        if ($event->user->activelogins->count()) 
        {
            $event->user->activelogins->each(function($active)
            {
                $active->delete();
            });
            
            $data['action'] = 'O';
            $event->user->loginhistory()->create($data);
            // Loginhistory::create($data);
            // Active_login::where('user_id',$id)->delete();
        }

        // inserrt active login
        $event->user->activelogins()->create($data);
        
        // $active_uesr = Active_login::where('user_id',$id)->first();
        // $id = ($event->user)?$event->user->id:NULL;
        // $active_uesr = Active_login::where('user_id',$id)->first();
        

        // Active_login::create($data);
        $data['action'] = 'L';
        $event->user->loginhistory()->create($data);

    
    }
}



        
        
        
        

