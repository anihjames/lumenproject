<?php

namespace App\interfaces;

interface Level
{
    public function create($attributes);
    public function getLevel();
    public function findbyId($id);
    public function update($request,$id);
    public function delete($id);

}