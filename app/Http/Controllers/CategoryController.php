<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
       
        $data = Category::all();
       
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
