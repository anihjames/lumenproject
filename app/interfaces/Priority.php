<?php

namespace App\interfaces;

interface Priority
{
    public function getpriorities();
    public function create($attributes);
    public function findbyId($id);
    public function update($request, $id);
    public function delete($id);

}