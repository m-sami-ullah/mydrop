<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Contactusreply extends Notification
{
    use Queueable;

    protected $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Thank you '.$this->name)
                    ->greeting('Thank you for getting in touch!')
                    ->line('')
                    ->line('We appreciate you contacting us. One of our colleagues will get back in touch with you soon!')
                    ->line('')
                    ->line('Have a great day!')
                    ->line('')
                    ->salutation(env('APP_NAME') . ' Team');
    }

     
}
