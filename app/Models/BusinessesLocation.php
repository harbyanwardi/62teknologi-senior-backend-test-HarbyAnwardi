<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BusinessesLocation extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function business() 
    {
        return $this->hasOne('App\Models\Business');
    }

    public function getLocation($business_id)
    {
        $data = BusinessesLocation::where('business_id', $business_id)
        ->select('address1','address2','address3','city','country','state','zip_code'
        )
        ->first();
        return $data;
    }
}
