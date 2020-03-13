<?php

namespace App\Models;


class Ticket extends BaseModel
{
    const STATUS_NEW  = 1;
    const STATUS_OPEN = 2;
    const STATUS_CLOSED = 3;

    const PRIORITY_CRITICAL = 1;
    const PRIORITY_HIGH = 2;
    const PRIORITY_MEDIUM = 3;
    const PRIORITY_LOW = 4;
    const PRIORITY_PLANNING = 5;
}