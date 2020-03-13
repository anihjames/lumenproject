<?php

namespace App\Listeners;

use App\Events\ReopenTicket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReopenTicketListener
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
     * @param  \App\Events\ReopenEvent  $event
     * @return void
     */
    public function handle(ReopenTicket $event)
    {
        //dd($event->ticket->ticket_number);
         DB::table('reopentickets')->insert([
             'ticket_number'=> $event->ticket->ticket_number,
             'prev_solution'=> $event->ticket->description,
         ]);


    }
}
