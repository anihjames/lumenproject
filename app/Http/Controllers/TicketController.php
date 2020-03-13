<?php

namespace App\Http\Controllers;


use App\Events\ReopenTicket;
use App\interfaces\contact;
use Illuminate\Http\Request;
use App\Repositories\Ticketservices;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{
    protected $tickets, $contacts, $msg, $msgCode, $code;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Ticketservices $ticketservices)
    {
        $this->tickets = $ticketservices;
        $this->middleware('auth');
    }

    
    public function index()
    {
       return $this->tickets->gettickets();
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject'=> 'required',
            'source'=> 'required',
            'program'=> 'required',
            'priority'=> 'required',
            'description'=> 'required',
        ]);
        $res = $this->tickets->log_ticket($request->all());
       
        //send mail 
        if($res){
            $this->msg = 'success';
            $this->msgCode = '1';
        }else{
            $this->msg = 'error';
            $this->msgCode = '0';
        }
        return response()->json(['status'=> $this->msg, 'msgcode'=> $this->msgCode]);
    }

    public function show($id)
    {
        $res = $this->tickets->getticketsbyid($id);
        if($res == ''){
            return response()->json(['msg'=> 'no data found']);
        }
        return response()->json($res);
    }


    public function update(Request $request, $id)
    {
        $res = $this->tickets->update_ticket($request->only(['subject', 'source', 'priority', 'status', 'program', 'contact_id', 'agent_id', 'level_id', 'descrription','attachments', 'reopen', 'other_sources','other_programs','reopen', 'issue_type']), $id);
        if($res){
            $this->msg = 'success';
            $this->code = 200;
        }else{
            $this->msg = "failed";
            $this->code = 400;
        }
        return response()->json(['status'=> $this->msg], $this->code);
    }

    public function Addnote(Request $request, $id)
    {
        $res = $this->tickets->dropnote($request->all(), $id);
        if($res){
            $this->msg = 'success';
            $this->code = 200;
        }else{
            $this->msg = "failed";
            $this->code = 400;
        }
        return response()->json(['status'=> $this->msg], $this->code);
    }

    public function ReplytoCustomer(Request $request, $id)
    {
        //dd($request->only(['solution', 'verified']));
        $res = $this->tickets->replytocustomer($request->all(), $id);
        if($res){
            $this->msg = 'success';
            $this->code = 200;
        }else{
            $this->msg = "failed";
            $this->code = 400;
        }
        return response()->json(['status'=> $this->msg], $this->code);
    } 

    // public function Forward(Request $request, $id)
    // {
    //     $res = $this->tickets->forwardticket($id, $request->only(['email', 'content']));
    // }

   public function reopen($id)
   {
       $res = $this->tickets->reopenticket($id);
       if($res){
            $this->msg = 'Ticket '. '#'. $id .' reopened';
            $this->code = 200;
        }else{
            $this->msg = "failed";
            $this->code = 400;
        }
    
    return response()->json(['status'=> $this->msg], $this->code);
      
   }

   public function closeticket($id)
   {
       $res = $this->tickets->closeticket($id);
       if($res){
            $this->msg = 'success';
            $this->code = 200;
        }else{
            $this->msg = "failed";
            $this->code = 400;
        }
        return response()->json(['status'=> $this->msg], $this->code);
   }

    public function delete($id)
    {
        $ticket = $this->tickets->delete($id);
        $ticket = 4;
        $ticket->save();
        return $ticket;
    }

    
}