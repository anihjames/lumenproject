<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyAgent extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;

    /**
     * Create a new message instance
     *  
     * @return void
     */ 

     public function __construct($agents)
     {
         $this->agent = $agents;
     }

     /**
     * Build the message
     *  
     * @return $this
     */ 

     public function build()
     {
         return $this->subject('Notification')->view('emails.notifyagent');
     }

     
}