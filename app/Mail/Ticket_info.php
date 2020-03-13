<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Ticket_info extends Mailable
{
    use Queueable, SerializesModels;

    public  $ticket, $contact;

    /**
     * Create a new message instance
     *  
     * @return void
     */ 

    public function __construct($ticketdetails)
    {
        $this->ticket = $ticketdetails;
    }

    /**
     * Build the message
     *  
     * @return $this
     */ 

    public function build()
    {
        return $this->subject('Support Ticket information')->view('emails.ticket_info')->with([
            'fname'=> $this->ticket[0]->fname,
            'subject'=> $this->ticket['subject'],
            'priority'=> $this->ticket['priority'],
            'status'=> $this->ticket['status'],
        ]);
    }
}