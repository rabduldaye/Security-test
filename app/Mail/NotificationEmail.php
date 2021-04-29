<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $greeting;
    public $introLines;
    public $actionText;
    public $actionUrl;
    public $level;
    public $outroLines;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $greeting, $introLines, $actionText, $actionUrl, $level, $outroLines)
    {
        //get the variables and set them
        $this->subject = $subject;
        $this->greeting = $greeting;
        $this->introLines = $introLines;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
        $this->level = $level;
        $this->outroLines = $outroLines;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ($this->actionUrl != null) {
            return $this->markdown('vendor.notifications.email')->subject($this->subject)->with(['displayableActionUrl' => $this->actionUrl]);
        } else {
            return $this->markdown('vendor.notifications.email')->subject($this->subject);// ->with('displayableActionUrl ', $this->actionURL);
        }

        
    }
}
