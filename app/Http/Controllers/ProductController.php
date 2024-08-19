<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function product()
    {
        $products = Product::all();
        return view('product.list', ['products' => $products]);
    }

    public function createProduct()
    {
        $categories = CategoryModel::all();
        return view('product.create', ['categories' => $categories]);
    }

    public function saveProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request['name'];
        $product->category_id = $request['category_id'];
        $product->quantity = $request['quantity'];
        $product->size = $request['size'];
        $product->neck_size = $request['neck_size'];
        $product->waist_width = $request['waist_width'];
        $product->purchase_price = $request['purchase_price'];
        $product->sale_price = $request['sale_price'];
        $product->off_price = $request['off_price'];
        if ($request['product_image']){
        $product->product_image = $this->uploadImage($request['product_image']);
        }
        $product->save();
        return redirect(route('product'));
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        $categories = CategoryModel::all();

        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request['name'];
        $product->category_id = $request['category_id'];
        $product->quantity = $request['quantity'];
        $product->size = $request['size'];
        $product->waist_width = $request['waist_width'];
        $product->neck_size = $request['neck_size'];
        $product->purchase_price = $request['purchase_price'];
        $product->sale_price = $request['sale_price'];
        $product->off_price = $request['off_price'];
        if (isset($request['product_image'])) {
            $product->product_image = $this->uploadImage($request['product_image']);
        }
        $product->save();
        return redirect(route('product'));
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product'));

    }

    private function uploadImage($image)
    {
        $path = Storage::putFile('public/products_images', $image);
        $path = explode('/', $path);
        array_splice($path, 0, 1);
        return join('/', $path);
    }
//    private function uploadImage($image)
//    {
//        $path = Storage::disk('s3')->putFile('public/products_images', $image, 's3');
//
//        // Generate a signed URL for the uploaded image
//        return  $path;
//
//    }
}
