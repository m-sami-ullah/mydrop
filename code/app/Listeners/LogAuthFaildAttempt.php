<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;
use App\Models\FaildAttempt;

class LogAuthFaildAttempt
{
    protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $id = ($event->user)?$event->user->id:NULL;
        $credentials = $event->credentials;
        $data['user_id']  = $id;
        $data['role_id']  = 1;
        if (array_key_exists('email',$credentials)) 
        {
            $data['email']    = $credentials['email'];
        } 
        
        $data['password'] = $credentials['password'];
        $data['ip']       = $this->request->server('REMOTE_ADDR');
        $data['details']  = serialize($this->request->server());
        FaildAttempt::create($data);
    }
}
