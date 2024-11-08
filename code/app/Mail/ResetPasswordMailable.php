<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $resetLink;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetLink, $customer)
    {
        $this->resetLink = $resetLink;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ret = $this
			->subject(__('Password Reset'))
			->markdown('emails.resetpassword');

		return $ret;
    }
}
