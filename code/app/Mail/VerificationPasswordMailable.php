<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationLink;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verificationLink, Customer $customer)
    {
        $this->verificationLink = $verificationLink;
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
			->subject(__('Verify Your Email Address'))
			->markdown('emails.userverify');
		return $ret;
    }
}
