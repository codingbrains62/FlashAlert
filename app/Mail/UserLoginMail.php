<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $region;
     public $name;
     public $username;
     public $url;
    public function __construct($region,$name,$username,$url,$useremail)
    {
        $this->region = $region;
        $this->name = $name;
        $this->username = $username;
        $this->url = $url;
        $this->useremail = $useremail;
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
        $user['username'] =  $this->username;
        $user['url'] =   $this->url;
        $user['useremail'] =  $this->useremail;

        return $this->from("flashalert@projects-codingbrains.com", "FlashAlert")
        ->subject('Your Login Details With us')
        ->view('template.send-user-login-mail', ['user' => $user]);
    }
}
