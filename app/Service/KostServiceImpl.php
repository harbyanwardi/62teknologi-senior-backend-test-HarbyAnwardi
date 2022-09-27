<?php

namespace App\Service;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;

class KostServiceImpl implements KostService 
{
    protected $kostRepository;
    public function __construct(Repository $kostRepository)
    {
        $this->kostRepository = $kostRepository;
    }
    public function add($data)
    {
        //di service kita gunakan logic bisnisnya
        $userCurrent =  Auth::user();
        $insertData = array(
            "kost_name" => $data['kost_name'],
            "location" => $data['location'],
            "price" => $data['price'],
            "owner_id" => $userCurrent['id'],
        );
        $this->kostRepository->store($insertData);
    }
}