<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email, $name, $token;

    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function build()
    {
        return $this
            ->to($this->email)
            ->from('customer@trade4uni.store')
            ->view('mails.forgot-password', [ 'name' => $this->name, 'token' => $this->token]);
    }
}
