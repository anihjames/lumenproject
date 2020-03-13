<?php

namespace App\Repositories;

use App\interfaces\contacts;
use App\interfaces\Tickets;
use App\Mail\NotifyAgent;
use App\Mail\SendResponse;
use App\Mail\Ticket_info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Ticketservices
{

    const STATUS_NEW  = 1;
    const STATUS_OPEN = 2;
    const STATUS_CLOSED = 3;

    const PRIORITY_CRITICAL = 1;
    const PRIORITY_HIGH = 2;
    const PRIORITY_MEDIUM = 3;
    const PRIORITY_LOW = 4;
    const PRIORITY_PLANNING = 5;

    protected $ticket, $contact, $newcontact, $other_sources, $other_program, $contact_id;

    public function __construct(Tickets $ticketservices, contacts $contacts)
    {
        $this->ticket = $ticketservices;
        $this->contact = $contacts;
    }

    public function gettickets()
    {
        return $this->ticket->gettickets();
    }

    public function getticketsbyId($id)
    {
        return $this->ticket->findbyId($id);
    }

    public function log_ticket($ticketdata)
    {
        
        if(!isset($ticketdata['contact_id'])){
            $contactdata = [
                'fname'=> $ticketdata['fname'],
                'lname'=> $ticketdata['lname'],
                'phone'=> $ticketdata['phone'],
                'email'=> $ticketdata['email'],
            ];
            $this->newcontact = $this->contact->create($contactdata);
            $this->contact_id = $this->newcontact->id;
        }else{
            $this->newcontact = $this->contact->findbyId($ticketdata['contact_id']);
        }   
            $data = [
                 'ticket'=>$ticketdata,
                'ticket_number'=> $this->generate_pid(),
                 'contact_id'=> $this->contact_id,   
            ]; 
          
            $res = $this->ticket->log_ticket($data);
            array_push($ticketdata, $this->newcontact);
            if($res){
                Mail::to($this->newcontact->email)->send(new Ticket_info($ticketdata));
                return true;
            }else{
                return false;
            }
             
    }

    public function update_ticket($data, $id)
    {
        return $this->ticket->update($data, $id);
    }

    public function dropnote($data, $id)
    {
        $notify_to = '';
        //$auth_user = Auth::user()->first_name;
        //dd($auth_user);
        if(isset($data['notify_to'])){
            $data['notify_agent'] = [
                'to_email'=> $data['notify_to'],
                'text'=> 'you where tagged in a note',
            ];
            //notify the agent that the note was tag with
            Mail::to($data['notify_to'])->send(new NotifyAgent($data));
         
        }
        $res = $this->ticket->comment($data, $id);
        return $res;
    }

    public function priorityNameFor($priority)
    {
        switch ($priority) {
            case static::PRIORITY_CRITICAL: return 'critical';
            case static::PRIORITY_HIGH: return 'high';
            case static::PRIORITY_MEDIUM : return 'medium';
            case static::PRIORITY_LOW: return 'low';    
        }
    }


    // public function forwardticket($id, $data)
    // {
    //     $checkticket_exist = $this->ticket->checkticketexists($id);
    //     dd($data['email']);
    // }

    public function replytocustomer($data, $id)
    {
        $ticket = $this->ticket->findbynumber($id);
        $contact['contact'] = $this->contact->findbyId($ticket->contact_id);
        $contact['solution'] = $data['solution'];
        //dd($contact);
        if($data['verified'] == 2){
            $closeticket = $this->closeticket($id);
        }
        array_push($data, $ticket->issue_type);
        $res = $this->ticket->solution($data, $id);
        if($res){
            Mail::to($contact['contact']['email'])->send(new SendResponse($contact, $ticket));
            return true;
        }
    }

    public function dropsolution($data, $id)
    {
        
    }

    public function closeticket($id)
    {
        $data = [
            'status'=> 3,
        ];
        return $this->ticket->update($data, $id);
    }

    public function reopenticket($id)
    {

    }

    public function escalateticket($data, $ticket)
    {
        //array_push($data, $ticket);
        $escalate = $this->ticket->escalate($data,$ticket);
        return $escalate;
        
    }

    
    public function delete($id)
    {

    }

    public function generate_pid() {
        $pin=mt_rand(1000,9999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }
}