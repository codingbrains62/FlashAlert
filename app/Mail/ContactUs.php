<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public $firstName;
    public $email;
    public $description;
    public function __construct($firstName, $email, $description)
    {
           $this->name = $firstName;
           $this->email = $email;
           $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name'] = $this->name;
        $user['email'] = $this->email;
        $user['description'] = $this->description;

        return $this->from("flashalert@projects-codingbrains.com", "ContactUs")
        ->subject('Flash Alert - New Contact Form Submission')
        ->view('template.contact-us', ['user' => $user])
        ->replyTo($this->email)
        //->cc($this->email) // Send a copy to the user who submitted the form
        ->cc('codingbrains62@gmail.com'); // Send a blind copy to your inbox
        // ->send(new AutoReply($user)); // Send the auto-reply email
    }
}
