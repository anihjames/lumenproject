<?php

namespace App\Events;

class TicketEvent extends Event
{
    public $ticket;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tickets)
    {
        $this->ticket = $tickets;
    }
}
