<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $products = Product::where('quantity' ,'>', '0')->get();
        return view('home',['products' => $products]);
    }
}
