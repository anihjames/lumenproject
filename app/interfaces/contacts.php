<?php

namespace App\interfaces;

interface contacts {
    public function create($data);
    public function findbyId($id);
}
