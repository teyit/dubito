<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class teyitInProgress extends Mailable
{
    use Queueable, SerializesModels;

    protected $caseTitle;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        //
        $this->caseTitle = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@teyit.org',"Dubito")
        ->subject("'".$this ->caseTitle."' incelemeye alındı")
        ->view('emails.teyitInProgress')
        ->with([
            "caseTitle" => $this ->caseTitle
        ]);
      //  return $this->view('view.name');
    }
}
