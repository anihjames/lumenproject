<?php

namespace App\Events;

class EventLog extends Event
{
    public $log, $desc;   
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventdata, $eventdesc)
    {
        $this->log = $eventdata;
        $this->desc = $eventdesc;
    }
}
