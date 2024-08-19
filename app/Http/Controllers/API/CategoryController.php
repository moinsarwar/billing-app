<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = CategoryModel::all();
        foreach ($categories as $category) {
            $category->category_image = getImageUrl($category->category_image);
        }
        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully',
        ]);
    }
}
