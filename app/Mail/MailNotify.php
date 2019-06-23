<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
	public $message;
    public $sender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $message)
    {
        $this->message = $message;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from($this->sender)
                ->view('emails.email')->with(['usermessage' => $this->message]);
    }
}
