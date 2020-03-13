<?php

namespace App\Events;

class ReopenTicket extends Event
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
