<?php

namespace App\Repositories;

use App\interfaces\Tickets;

class DashboardServices 
{
    protected $ticket;
    public function __construct(Tickets $ticketservices)
    {
        $this->ticket = $ticketservices;
    }

    
}