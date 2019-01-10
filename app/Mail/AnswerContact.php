<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnswerContact extends Mailable
{
    use Queueable, SerializesModels;

    private $contact;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $body)
    {
        $this->contact = $contact;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sandbox@sparkpostbox.com')
                    ->to($this->contact->email)
                    ->markdown('emails/answer-contact')
                    ->subject('Re: '.$this->contact->object)
                    ->with([
                        'fullname' => $this->contact->fullname,
                        'message' => $this->body 
                    ]);
    }
}
