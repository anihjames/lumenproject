<?php

namespace App\Http\Controllers;

use App\interfaces\contact;
use Illuminate\Http\Request;
use App\Repositories\Ticketservices;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{
    protected $tickets, $contacts, $msg, $msgCode;
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
        $res = $this->tickets->getticketsbyId($id);
        if($res == ''){
            return response()->json(['msg'=> 'no data found']);
        }
        return response()->json($res);
    }


    public function update(Request $request, $id)
    {
        $res = $this->tickets->update_ticket($request->all(), $id);
        if($res == '1'){
            $this->msg = "success";
            $this->msgCode = "1";
        }else{
            $this->msg = "failed";
            $this->msgCode = "0";
        }
        return response()->json(['status'=> $this->msg, 'statusCode'=> $this->msgCode]);
    }

    public function Addnote(Request $request, $id)
    {
        $res = $this->tickets->dropnote($request->all(), $id);
        if($res){
            $this->msg = "success";
            $this->msgCode = '1';
        }else{
            $this->msg = "failed";
            $this->msgCode = "0";
        }
        return response()->json(['status'=> $this->msg, 'statusCode'=> $this->msgCode]);
    }

    public function ReplytoCustomer(Request $request, $id)
    {
        //dd($request->only(['solution', 'verified']));
        $res = $this->tickets->replytocustomer($request->all(), $id);
        if($res){
            $this->msg = "success";
            $this->msgCode = '1';
        }else{
            $this->msg = "failed";
            $this->msgCode = "0";
        }
        return response()->json(['status'=> $this->msg, 'statusCode'=> $this->msgCode]);
    } 

    // public function Forward(Request $request, $id)
    // {
    //     $res = $this->tickets->forwardticket($id, $request->only(['email', 'content']));
    // }

    public function escalate(Request $request, $id)
    {
        dd($request->only(['level, agent']));
    }

    public function delete($id)
    {
        $ticket = $this->tickets->delete($id);
        $ticket = 4;
        $ticket->save();
        return $ticket;
    }

    
}