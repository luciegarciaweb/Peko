<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSent extends Mailable
{
    use Queueable, SerializesModels;

    private $body;
    private $object;
    private $emails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($object, $body, $emails)
    {
        $this->body = $body;
        $this->object = $object;
        $this->emails = $emails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sandbox@sparkpostbox.com')
                    ->bcc($this->emails)
                    ->markdown('emails/newsletter-sent')
                    ->subject($this->object)
                    ->with([
                        'body' => $this->body
                    ]);
    }
}
