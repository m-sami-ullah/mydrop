<?php

namespace App\Providers;

use App\Listeners\LogAuthFaildAttempt;
use App\Listeners\LogSuccessLogin;
use App\Listeners\LogSuccessLogout;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
         Failed::class => [
        
            LogAuthFaildAttempt::class,
        ],

        Login::class => [
            LogSuccessLogin::class,
        ],
        
        Logout::class => [
            LogSuccessLogout::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
