<?php

namespace App\Repositories;

use App\interfaces\Level;
use Illuminate\Support\Facades\DB;

class LevelRepo implements Level
{
    private function tableinstance()
    {
        return DB::table('levels');
    }

    public function create($attributes)
    {
        return $this->tableinstance()->insert($attributes);
    }

    public function getLevel()
    {
        return $this->tableinstance()->get();
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