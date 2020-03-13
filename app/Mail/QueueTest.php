<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueTest extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;

    /**
     * Create a new message instance
     *  
     * @return void
     */ 

     public function __construct()
     {
         
     }

     /**
     * Build the message
     *  
     * @return $this
     */ 

     public function build()
     {
         return $this->from('test@gmail.com', 'Queue')
                    ->subject('Notification')->view('emails.queuetest');
     }

     
}