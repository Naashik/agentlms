<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.otpmail');

        // return $this->markdown('emails.otpmail')
        // // ->from('ruhaim860@gmail.com',env('APP_NAME'))
        // ->subject('Hello')
        // ->with(['data' => $this->data]);

        return $this->from('callpointvk@gmail.com')
               ->subject('Mail From EDGE')
               ->markdown('emails.otpmail',["data"=>$this->data]);
    }

    
}