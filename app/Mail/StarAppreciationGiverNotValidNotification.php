<?php

namespace App\Mail;

use App\Models\StarAppreciation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StarAppreciationGiverNotValidNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The STAR appreciation entry instance.
     *
     * @var \App\Models\StarAppreciation
     */
    public $entry;

    /**
     * The giver's total submission count for the current month.
     *
     * @var int
     */
    public $monthlyCount;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\StarAppreciation  $entry
     * @param  int  $monthlyCount
     * @return void
     */
    public function __construct(StarAppreciation $entry, int $monthlyCount)
    {
        $this->entry = $entry;
        $this->monthlyCount = $monthlyCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('About your Mega Thank You Card submission')
                    ->view('emails.star-appreciation-giver-not-valid');
    }
}
