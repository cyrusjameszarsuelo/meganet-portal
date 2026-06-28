<?php

namespace App\Mail;

use App\Models\StarAppreciation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StarAppreciationReceiverNotValidNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The STAR appreciation entry instance.
     *
     * @var \App\Models\StarAppreciation
     */
    public $entry;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\StarAppreciation  $entry
     * @return void
     */
    public function __construct(StarAppreciation $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You received a Mega Thank You Card from a colleague!')
                    ->view('emails.star-appreciation-receiver-not-valid');
    }
}
