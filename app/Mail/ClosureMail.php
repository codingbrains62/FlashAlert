<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClosureMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $senderemail;
    public $csubject;
    public $message;
    public $primaryname; 
    public $secondaryName;
    public function __construct($senderemail, $csubject, $message, $primaryname='', $secondaryName='')
    {
        $this->senderemail = $senderemail;
        $this->csubject = $csubject;
        $this->message = $message;
        $this->secondaryName = $secondaryName;
        $this->primaryname = $primaryname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       //$user['senderemail'] = $this->senderemail;
        //$user['csubject'] = $this->csubject;
        $user['message'] = $this->message;
        $user['secondaryName'] = $this->secondaryName;
        $user['primaryname'] = $this->primaryname;
        return $this->from($this->senderemail, "Test Closer")
        ->subject($this->csubject)
        ->view('template.closureMess', ['user' => $user]);
    }
}
