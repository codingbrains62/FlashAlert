<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReqUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $SiteURL;
    public $CityName;
    public $Name;
    public $mail;
    public function __construct($SiteURL,$CityName,$Name,$mail)
    {
        $this->SiteURL = $SiteURL;
        $this->CityName = $CityName;
        $this->Name = $Name;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['SiteURL'] = $this->SiteURL;
        $user['CityName'] = $this->CityName;
        $user['Name'] = $this->Name;
        $user['mail'] = $this->mail;

        return $this->from("flashalert@projects-codingbrains.com", "update")
        ->subject('URGENT:Please Review Your FlashAlert Contact Info')
        ->view('template.requpdate', ['user' => $user]);
    }
}
