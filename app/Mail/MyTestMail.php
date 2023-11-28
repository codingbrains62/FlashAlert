<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $password;
    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name'] = $this->name;
        $user['password'] = $this->password;
        return $this->from("codingbrains32@gmail.com", "FlashAlert")
        ->subject('Your Login Details With us')
        ->view('template.send-password', ['user' => $user]);
    }
}
