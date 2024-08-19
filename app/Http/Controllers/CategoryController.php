<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;


class CategoryController extends Controller
{
    public function productCategory()
    {
        $productCategories = CategoryModel::all();
        return view('product-category.list',['categories' => $productCategories]);
    }
    public function createProductCategory()
    {
        return view('product-category.create');
    }
    public function saveProductCategory(Request $request)
    {
        $category = new CategoryModel();
        $category->name = $request['product_category_name'];
        $category->category_image = $this->uploadImage($request['product_category_image']);
        $category->save();

        return redirect(route('productCategory'));
    }
    public function editProductCategory($id)
    {
        $category = CategoryModel::find($id);
        return view('product-category.edit',['category' => $category]);
    }
    public function updateProductCategory(Request $request , $id)
    {
        $category = CategoryModel::find($id);
        $category->name = $request['product_category_name'];
        if (isset($request['product_category_image'])) {
            $category->category_image = $this->uploadImage($request['product_category_image']);
        }
        $category->save();
        return redirect(route('productCategory'));

    }
    public function deleteProductCategory($id)
    {
        $category = CategoryModel::find($id);
        $category->delete();
        return redirect(route('productCategory'));

    }
//    private function uploadImage($image)
//    {
//        try {
//            $path = Storage::disk('s3')->putFile('public/categories_images', $image);
////            $signedUrl = Storage::disk('s3')->temporaryUrl(
////                $path,
////                Carbon::now()->addMinutes(60) // Signed URL expiration time (60 minutes)
////            );
////            return $signedUrl;
//            $publicUrl = Storage::disk('s3')->url($path);
//            return $publicUrl;
//        } catch (\Exception $e) {
//            // Log the error message
//            Log::error('Upload image error: ' . $e->getMessage());
//            return false;
//        }
//    }
    private function uploadImage($image)
    {
        $path = Storage::putFile('public/categories_images', $image);
        $path = explode('/', $path);
        array_splice($path, 0, 1);
        return join('/', $path);
    }
//    private function uploadImage($image)
//    {
//        $path = Storage::disk('s3')->putFile('public/categories_images', $image, 's3');
//
//        // Generate a signed URL for the uploaded image
//           return  $path;
//
//    }


}
