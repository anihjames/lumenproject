<?php

namespace App\interfaces;

interface issuesType
{
    public function create($attributes);
    public function getIssuesType();
    public function findbyId($id);
    public function update($request, $id);
    public function delete($id);
}