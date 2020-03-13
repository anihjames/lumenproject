<?php

namespace App\interfaces;

interface Source {

    public function getsources();
    public function create($attributes);
    public function findbyId($id);
    public function update($request, $id);
    public function delete($id);
}