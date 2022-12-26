<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessesCategory extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function getCategories($business_id)
    {
        $data = BusinessesCategory::join('business_category_relation as t01', 't01.category_id', '=', 'businesses_categories.id')
        ->join('businesses as t03', 't03.id', '=', 't01.business_id')
        ->where('business_id', $business_id)
        ->get(['businesses_categories.alias','businesses_categories.title']);
        return $data;
    }
}
