<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Category;

class ProductAPI extends Controller
{
    

    public function product_list() {
        $data = Product::all();

        return response()->json([
            'status' => $data ? true : false,
            'value' => $data
        ]);

    }

    public function product_search(Request $request) {
        $word = $request->word;

        if($word) {
            $products = Product::where('name', 'like', '%'.$word.'%')->get();
        } else {
            $products = Product::all();
        }
        return response()->json([
            'status' => $products ? true : false,
            'value' => $products
        ]);

    }


}
