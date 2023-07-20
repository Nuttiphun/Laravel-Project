<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryAPI extends Controller
{
    
    public function category_list() {
        return response()->json([
            'status' => true,
            'value' => Category::all() 
        ]);
    }

}
