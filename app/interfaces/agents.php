<?php

namespace App\interfaces;

interface agents
{
    public function create($attributes);
    public function login($domain);
    public function getAgents();
    public function getstatus();
    public function Authagent();
    public function agentdetails($id);
    public function update($request, $domain);
    public function logout($token);
    public function delete($id);
}