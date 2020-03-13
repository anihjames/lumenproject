<?php

namespace App\Jobs;

use App\Mail\Ticket_info;
use Illuminate\Support\Facades\Mail;

class TicketJob extends Job
{
    //protected $detail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->detail = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //sending mail to mulitple users
        // $email = new Ticket_info();
        //     Mail::to($this->detail)
        //             ->bcc($this->detail)
        //             ->send($email);
        
       
       
    }
}
