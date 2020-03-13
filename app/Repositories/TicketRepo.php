<?php

namespace App\Repositories;

use App\interfaces\Tickets;
use Illuminate\Support\Facades\DB;
use App\Util\Service;

class TicketRepo implements Tickets
{
    protected $services;

    public function __construct(Service $service)
    {
        $this->services = $service;
    }
    public function tableinstance()
    {
        return DB::table('tickets');
    }

    public function checkticketexists($ticket_number)
    {
        return DB::table('tickets')->where('ticket_number', $ticket_number)->exists();
    }

    public function getTickets()
    {
        return $this->tableinstance()->where('status', 1)->get();
    }

    public function findbyId($id)
    {
        return $this->tableinstance()->find($id);
    }

    public function getlastInserted()
    {
        return DB::getPdo()->lastInsertId();
    }

    public function findbynumber($id)
    {
        return $this->tableinstance()->where('ticket_number', $id)->first();
    }

    public function log_ticket($data)
    {
        $priority = $data['ticket']['priority'];
        $getresolutuion = DB::table('priority')->where('id', $priority)->value('resolution_time');
        
        if(isset($data['contact_id']) || isset($data['ticket']['level_id']) ){
          
           $ticketdetails = [
            'subject'=> $data['ticket']['subject'],
            'source'=> $data['ticket']['source'],
            'priority'=> $data['ticket']['priority'],
            'status'=> $data['ticket']['status'],
            'program'=> $data['ticket']['program'],
            'contact_id'=> intVal($data['contact_id']),
            'agent_id'=> $data['ticket']['agent_id'],
            'level_id'=> $data['ticket']['level_id'],
            'description'=> $data['ticket']['description'],
            'ticket_number'=> $data['ticket_number'],
            'issue_type'=> $data['ticket']['issue_type'],
            // 'other_programs'=> $data['ticket']['other_program'],
            // 'other_sources'=> $data['ticket']['other_source'],
            'time_resolution'=> $getresolutuion,
           ];
        }else{
            $ticketdetails = [
            'subject'=> $data['ticket']['subject'],
            'source'=> $data['ticket']['source'],
            'priority'=> $data['ticket']['priority'],
            'status'=> $data['ticket']['status'],
            'program'=> $data['ticket']['program'],
            'contact_id'=> intVal($data['ticket']['contact_id']),
            'agent_id'=> $data['ticket']['agent_id'],
            // 'level_id'=> $data['ticket']['level_id'],
            'description'=> $data['ticket']['description'],
            'ticket_number'=> $data['ticket_number'],
            'time_resolution'=> $getresolutuion,
            'issue_type'=> $data['ticket']['issue_type'],
            ];
        }

        return $this->tableinstance()->insert([$ticketdetails]);
    }

    public function update($data, $id)
    {
        return $this->tableinstance()->where('ticket_number', $id)->update($data);
    }

    public function comment($data, $id)
    {
        $notify_to = '';
        if(isset($data['notify_to'])){
            $notify_to = $data['notify_to'];
        }
        
        return DB::table('comments')->insert([
            'notify_to'=> $notify_to,
            'ticket_number'=> $id,
            'description'=> $data['note'],
            'agent_id'=> $data['agent_id'],
        ]);
    }


    public function notifyAgent($data)
    {
        return DB::table('notifications')->insert($data);
    }

    public function solution($data, $id)
    {
       // dd($data[0]);
        // 1(for waiting for customer response)
        // 2(for confirmed by customer)
        return DB::table('solutions')->insert([
            'ticket_number'=> $id,
            'issue_type'=> $data[0]   ,
            'description'=> $data['solution'],
            //'agent_id=> $this->services->LoggedInUser()->id
            'agent_id'=> 1,
            //'verified'=> $data['verified'],
        ]);
    }

    public function escalate($data, $ticket_number)
    {
        if(isset($data['level'])){
            $logescalation = DB::table('escalations')->insert([
                'agent'=> $data['agent'],
                'level'=> $data['level'],
                'ticket_number'=> $ticket_number
            ]);
        }else{
            $logescalation = DB::table('escalations')->insert([
                'agent'=> $data['agent'],
                //'level'=> $data['level'],
                'ticket_number'=> $data['ticket_number']
            ]);
        }

         return DB::table('tickets')->where('ticket_number', $ticket_number)->update([
            'is_escalated'=> true,
         ]);
       
    }

    public function reopenticket($id)
    {

    }

    public function delete($id)
    {

    }



}