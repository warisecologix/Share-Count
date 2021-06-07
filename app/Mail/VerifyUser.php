<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyUser extends Mailable
{
    use Queueable, SerializesModels;

    public $random_number;

    public function __construct($rand)
    {
        $this->random_number = $rand;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->markdown('email.sendtoken', compact('random_number'));
        return $this->markdown('email.sendtoken')->with('random_number',$this->random_number);
    }
}
