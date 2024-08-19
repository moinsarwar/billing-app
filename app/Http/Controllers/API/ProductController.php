<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->product_image = getImageUrl($product->product_image);
        }
        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully',
        ]);    }
}
