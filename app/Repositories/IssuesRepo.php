<?php

namespace App\Repositories;

use App\interfaces\issuesType;
use Illuminate\Support\Facades\DB;

class IssuesRepo implements issuesType
{
    
    public function tableinstance()
    {
        return DB::table('issues');
    }

    public function getIssuesType()
    {
        return $this->tableinstance()->get();
    }

    public function create($attributes)
    {
        return $this->tableinstance()->insert($attributes);
    }

    public function findbyId($id)
    {
        return $this->tableinstance()->find($id);
    }

    public function update($request, $id)
    {
        return $this->tableinstance()->where('id', $id)->update($request);
    }

    public function delete($id)
    {
        return $this->tableinstance()->where('id', $id)->delete();
    }
}