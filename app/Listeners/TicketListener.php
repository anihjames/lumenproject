<?php

namespace App\Listeners;

use App\Events\TicketEvent;
use App\Mail\Ticket_info;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TicketListener implements ShouldQueue
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
    public function handle(TicketEvent $event)
    {
        Mail::to($event->ticket[0]->email)->send(new Ticket_info($event->ticket));

    }
}
