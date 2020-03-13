<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Ticketservices;

class EscalationController extends Controller
{
    protected $ticket;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Ticketservices $ticketservices)
    {
        $this->ticket = $ticketservices;
    }

    public function store(Request $request, $ticket_number)
    {
        $escalate = $this->ticket->escalateticket($request->only(['level', 'agent']), $ticket_number);
        if($escalate){
            return response()->json(['status'=> 'success'], 200);
        }else{
            return response()->json(['status'=>'error'], 400);
        }
    }

    public function destroy()
    {

    }

    

    //
}
