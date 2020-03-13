<?php

namespace App\interfaces;

interface Tickets
{
    //public function tableinstance();
    public function getTickets();
    public function checkticketexists($ticket_number);
    public function escalate($data,$ticket_number);
    public function log_ticket($data);
    public function getlastInserted();
    public function find($id);
    public function findbynumber($id);
    public function update($data, $id);
    public function comment($data, $id);
    public function solution($data, $id);
    public function reopenticket($id);
    public function notifyAgent($data);
    public function delete($id);

}