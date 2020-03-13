<?php

namespace App\Events;

class Notify_agent extends Event
{
    public $agentdata;   
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->agentdata = $data;
    }
}
