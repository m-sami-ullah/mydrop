<?php

namespace App\Listeners;

use App\Models\Active_login;
use App\Models\Loginhistory;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
class LogSuccessLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {

        // dd($event);
        $user_id = ($event->user)?$event->user->id:NULL;;
        if ($user_id) 
        {
            $user = User::find($user_id);
            if ($user->activelogins->count()) 
            {
                $user->activelogins->each(function($active)
                {
                    $active->delete();
                });

                $data = array(
                        'token'     => $user->id,
                        'ip'        => $this->request->server('REMOTE_ADDR')
                        );

                $data['action'] = 'O';
                $data['details'] = serialize($this->request->server());
                $user->loginhistory()->create($data);
                
            }
        }
    }
}
