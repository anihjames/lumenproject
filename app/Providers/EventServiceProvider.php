<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        \App\Events\ReopenTicket::class => [
            \App\Listeners\ReopenTicketListener::class,
        ],
        \App\Events\TicketEvent::class => [
            \App\Listeners\TicketListener::class,
        ],
        \App\Events\EventLog::class => [
            \App\Listeners\EventLogListener::class,
        ],
        \App\Events\Notify_agent::class => [
            \App\Listeners\notifyagentListener::class,
        ],
    ];


   
}
