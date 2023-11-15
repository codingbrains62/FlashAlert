<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $region;
     public $name;
    
    public function __construct($region,$name)
    {
        $this->region =$region;
        $this->name =$name;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['region'] =  $this->region;
        $user['name'] =  $this->name;

        return $this->from("flashalert@projects-codingbrains.com", "Test")
        ->subject('Flash Alert -Account Validation')
        ->view('template.register-user-mail', ['user' => $user]);
    }
}
