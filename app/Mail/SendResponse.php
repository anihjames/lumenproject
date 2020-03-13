<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $contact, $ticket;

    /**
     * Create a new message instance
     *  
     * @return void
     */ 

    public function __construct($contacts, $tickets)
    {
        $this->contact = $contacts;
        $this->ticket = $tickets;
    }

    /**
     * Build the message
     *  
     * @return $this
     */ 

    public function build()
    {
        //dd($this->ticket->issue_type);
        return $this->subject('Re:'. ' '.$this->ticket->issue_type)->view('emails.sendResponse');
    }
}