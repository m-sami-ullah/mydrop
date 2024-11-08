<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Messagebird\MessagebirdChannel;
use NotificationChannels\Messagebird\MessagebirdMessage;

class LoginPhoneCode extends Notification
{
    use Queueable;

    protected $code;
    protected $phone;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code,$phone)
    {
        $this->code = $code;
        $this->phone = $phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [MessagebirdChannel::class];
    }

    public function toMessagebird($notifiable)
    {
        return (new MessagebirdMessage($this->code . ' ' . __('lang.your_oui_verification_code')))->setRecipients($this->phone);
        // return (new MessagebirdMessage($this->comment));
    }
}
