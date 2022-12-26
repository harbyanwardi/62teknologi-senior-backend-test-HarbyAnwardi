<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessesCoordinate extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function getCoordinate($business_id)
    {
        $data = BusinessesCoordinate::where('business_id', $business_id)->first(['latitude','longitude']);
        return $data;
    }
}
