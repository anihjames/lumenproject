<?php

namespace App\Listeners;

use App\Events\EventLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class EventLogListener
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
    public function handle(EventLog $event)
    {
        
        DB::table('events_logs')->insert([
            'event_id'=> $event->log->id,
            'body'=> $event->desc,
            'agent'=>  $event->log->agent_id,
        ]);

        //notifiy the agent that a ticket was updated
        $agent_id = DB::table('agents')->where('id', $event->log->agent_id)->value('email');

        DB::table('notifications')->insert([
            'to_email'=> $agent_id,
            'text'=> 'ticket updated'
        ]);
    }
}
