<?php

namespace App\Repository;

use App\Models\Kost;

class KostImplement implements Repository 
{
    public function store($data) {

        $kost = new Kost();
        $kost->create($data);
    }
}