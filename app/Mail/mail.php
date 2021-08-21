<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mail extends Mailable
{
    use Queueable, SerializesModels;
    public $data1;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data1=$data;
        // dd($this->data1);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.leadmail')->with('message', $this->message); ->from('john@webslesson.info')
        return $this->subject('New Lead Added')->markdown('emails.leadmail')->with('data', $this->data1);
    }
}
