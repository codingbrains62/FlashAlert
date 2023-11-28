<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $token;
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            $user['user'] = $this->user;
            $user['token'] = $this->token;
            //dd($user['user']);
            return $this->from("flashalert@projects-codingbrains.com", "FlashAlert")
            ->subject('Flashalert Account Recovery')
            ->view('template.msg-reset_password', ['user' => $user]);
        }
}
