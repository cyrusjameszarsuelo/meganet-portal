<?php

namespace App\Mail;

use App\Models\StarAppreciation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StarAppreciationGiverValidNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The STAR appreciation entry instance.
     *
     * @var \App\Models\StarAppreciation
     */
    public $entry;

    /**
     * The number of commendations the giver has remaining this month.
     *
     * @var int
     */
    public $remainingCommendations;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\StarAppreciation  $entry
     * @param  int  $remainingCommendations
     * @return void
     */
    public function __construct(StarAppreciation $entry, int $remainingCommendations)
    {
        $this->entry = $entry;
        $this->remainingCommendations = $remainingCommendations;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Mega Thank You Card has been sent!')
                    ->view('emails.star-appreciation-giver-valid');
    }
}
