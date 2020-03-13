<?php

namespace App\Jobs;

use App\Mail\QueueTest;
use Illuminate\Support\Facades\Mail;

class Queuetestmail extends Job
{
    protected $detail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->detail = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //sending mail to mulitple users
        $email = new QueueTest();
            Mail::to($this->detail)
                    ->bcc($this->detail)
                    ->send($email);
        
       
       
    }
}
