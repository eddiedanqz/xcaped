<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenerateQrCodeMail extends Mailable
{
    use Queueable, SerializesModels;

        /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $attendee;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Attendee  $attendee
     * @return void
     */
    public function __construct(Attendee $attendee)
    {
        $this->$attendee = $attendee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.emails.qrcode');
    }
}
