<?php

namespace App\Repositories;

use App\interfaces\agents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentsRepo implements agents
{

    public function getAgents()
    {
        return DB::table('agents')->get();
    }

    public function getstatus()
    {
        return DB::table('status')->get();
    }

    public function Authagent()
    {
        return Auth::user();
    }

    public function create($attributes)
    {
        if(isset($attributes['level_id']) || isset($attributes['role'])){
            return DB::table('agents')->insert([
                'level_id'=> $attributes['level_id'],
                'role'=> $attributes['role'],
                'first_name'=> $attributes['first_name'],
                'last_name'=> $attributes['last_name'],
                'phone'=> $attributes['phone'],
                'email'=> $attributes['email'],
                'domain_name'=> $attributes['first_name'] . '@helpdesk.com'
            ]);
        }else{
            return DB::table('agents')->insert([
                // 'level_id'=> $attributes['level_id'],
                // 'role'=> $attributes['role'],
                'first_name'=> $attributes['first_name'],
                'last_name'=> $attributes['last_name'],
                'phone'=> $attributes['phone'],
                'email'=> $attributes['email'],
                'domain_name'=> $attributes['first_name'] . '@helpdesk.com'
            ]);
        }
        return DB::table('agents')->insert($attributes);
    }

    // public function createdomain_name($attributes)
    // {
    //     return DB::table('')
    // }


    public function login($domain)
    {
        return  DB::table('agents')->where('email', $domain)->exists();   
    }

    public function logout($token)
    {
        $agent =  DB::table('agents')->where('token', $token)->exists();
        if($agent){
           return DB::table('agents')->where('token', $token)->update([
               'token'=> null,
           ]);
        }else{
            return false;
        }

        
        
    }


    public function agentdetails($domain)
    {
        return DB::table('agents')->where('email', $domain)->first();
    }

    public function update($request, $domain)
    {
       
        return DB::table('agents')->where('email', $domain)->update($request);
    }

    public function delete($id)
    {

    }
}