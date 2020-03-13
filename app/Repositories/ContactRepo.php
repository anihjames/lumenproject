<?php 

namespace App\Repositories;

use App\Models\Contact;
use App\interfaces\contacts;
use Illuminate\Support\Facades\DB;

class ContactRepo implements contacts
{
    
    public function create($data)
    {
        return Contact::create($data);
    }

    public function findbyId($id)
    {
        return DB::table('contacts')->find($id);
        //return Contact::find($id);
    }
}