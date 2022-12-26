<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategoryRelation extends Model
{
    protected $guarded = ['id'];
    protected $table = 'business_category_relation';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function business() {
        return $this->belongsTo('App\Models\Business');
    }

    public function businesscategory() {
        return $this->belongsTo('App\Models\BusinessesCategory');
    }
}
