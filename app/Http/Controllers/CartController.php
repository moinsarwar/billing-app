<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bill;
use App\Models\BillItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cartData = $request->input('cart', []);
        $billId = $request->input('bill_id');
        $totalAmount = 0;

        foreach ($cartData as $item) {
            $product = Product::find($item['id']);
            if ($product && $product->quantity >= $item['quantity']) {
                Log::info("Product found: {$product->name}, Price: {$product->price}, Quantity in stock: {$product->quantity}");

                $cart = Session::get('cart', []);
                $cart[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity']
                ];
                Session::put('cart', $cart);
                $product->quantity -= $item['quantity'];
                $product->save();

                $discountedPrice = $product->sale_price - ($product->off_price ?? 0);
                $totalAmount += $discountedPrice * $item['quantity'];
            } else {
                return response()->json(['success' => false, 'message' => 'One or more products are out of stock or not found']);
            }
        }

        Log::info("Final Total Amount: $totalAmount");

        $bill = Bill::create([
            'bill_id' => $billId,
            'date' => now(),
            'total_amount' => $totalAmount,
        ]);

        foreach ($cartData as $item) {
            $product = Product::find($item['id']);
            $discountedPrice = $product->sale_price - ($product->off_price ?? 0);
            BillItem::create([
                'bill_id' => $bill->id,
                'product_id' => $product->id,
                'product_name' => $item['name'],
                'product_size' => $item['size'],
                'product_price' => $discountedPrice,
                'quantity' => $item['quantity'],
                'total_amount' => $discountedPrice * $item['quantity'],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
