<?php

namespace App\Listeners;

use App\Events\Notify_agent;
use App\Mail\NotifyAgent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class notifyagentListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ExampleEvent  $event
     * @return void
     */
    public function handle(Notify_agent $event)
    {
      
        Mail::to($event->agentdata['to_email'])->send(new NotifyAgent($event->agentdata));

        // DB::table('notifications')->insert([
        //     'to_email'=> $event['notify_to'],

        // ]);
    }
}
