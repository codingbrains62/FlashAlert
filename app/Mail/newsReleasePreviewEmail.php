<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newsReleasePreviewEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $headline;
    public $postText;
    public $contactInfo;
    public $orgDropdown;
    public function __construct($headline, $postText, $contactInfo, $orgDropdown)
    {
        $this->headline = $headline;
        $this->postText = $postText;
        $this->contactInfo = $contactInfo;
        $this->orgDropdown = $orgDropdown;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['headline'] = $this->headline;
        $user['postText'] = $this->postText;
        $user['contactInfo'] = $this->contactInfo;
        $user['orgDropdown'] = $this->orgDropdown;
        return $this->from("flashalert@projects-codingbrains.com", $user['orgDropdown'])
        ->subject($user['headline'])
        ->view('template.newsReleasePreviewEmail', ['user' => $user]);
    }
}
