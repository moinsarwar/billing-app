<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function product()
    {
        Log::info('Fetching all products');
        $products = Product::all();
        return view('product.list', ['products' => $products]);
    }

    public function createProduct()
    {
        Log::info('Fetching categories for product creation');
        $categories = CategoryModel::all();
        return view('product.create', ['categories' => $categories]);
    }

    public function saveProduct(Request $request)
    {
        Log::info('Saving new product', ['request' => $request->all()]);
        try {
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

            if ($request->hasFile('product_image')) {
                $product->product_image = $this->uploadImage($request['product_image']);
            }

            $product->save();
            Log::info('Product saved successfully', ['product_id' => $product->id]);
            return redirect(route('product'));
        } catch (\Exception $e) {
            Log::error('Error saving product', ['error' => $e->getMessage()]);
            return back()->withErrors('Error saving product');
        }
    }

    public function editProduct($id)
    {
        Log::info("Fetching product for editing", ['product_id' => $id]);
        $product = Product::find($id);
        $categories = CategoryModel::all();

        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function updateProduct(Request $request, $id)
    {
        Log::info("Updating product", ['product_id' => $id, 'request' => $request->all()]);
        try {
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

            if ($request->hasFile('product_image')) {
                $product->product_image = $this->uploadImage($request['product_image']);
            }

            $product->save();
            Log::info('Product updated successfully', ['product_id' => $product->id]);
            return redirect(route('product'));
        } catch (\Exception $e) {
            Log::error('Error updating product', ['error' => $e->getMessage()]);
            return back()->withErrors('Error updating product');
        }
    }

    public function deleteProduct($id)
    {
        Log::info("Deleting product", ['product_id' => $id]);
        try {
            $product = Product::find($id);
            $product->delete();
            Log::info('Product deleted successfully', ['product_id' => $id]);
            return redirect(route('product'));
        } catch (\Exception $e) {
            Log::error('Error deleting product', ['error' => $e->getMessage()]);
            return back()->withErrors('Error deleting product');
        }
    }

    private function uploadImage($image)
    {
        Log::info('Uploading image');
        try {
            $path = Storage::putFile('public/products_images', $image);
            $path = explode('/', $path);
            array_splice($path, 0, 1);
            $finalPath = join('/', $path);
            Log::info('Image uploaded successfully', ['path' => $finalPath]);
            return $finalPath;
        } catch (\Exception $e) {
            Log::error('Error uploading image', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
