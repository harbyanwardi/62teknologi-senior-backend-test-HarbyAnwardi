<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAvailRoom extends Model
{
    protected $table = 'log_ask_avail_room';

    protected $fillable = [
        'customer_id','owner_id','kost_id','message'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
}
