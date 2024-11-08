<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Contactus extends Notification
{
    use Queueable;

    protected $message;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->greeting('The following inquiry received')
                    ->line('')
                    ->line("Name: ".$this->message->name)
                    ->line("Email: ".$this->message->email)
                    ->line("Subject: ".$this->message->subject)
                    ->line("Message: ".$this->message->message)
                    ->line('')
                    ->salutation(env('APP_NAME').' Team');
    }

    public function toArray($notifiable)
    {
        return [
            'inquiry' => [
                "Name" => $this->message->name,
                "Email" => $this->message->email,
                "Subject" => $this->message->subject,
                "Message" => $this->message->message,
                ],
        ];
    }
     
}