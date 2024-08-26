<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home'])->name('home');

Route::get('/dashboard',[DashboardController::class , 'dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('product',[ProductController::class,'product'])->name('product');
    Route::get('product/create',[ProductController::class,'createProduct'])->name('createProduct');
    Route::post('product/save',[ProductController::class,'saveProduct'])->name('saveProduct');
    Route::get('product/edit/{id}',[ProductController::class,'editProduct'])->name('editProduct');
    Route::post('product/edit/{id}',[ProductController::class,'updateProduct'])->name('updateProduct');
    Route::get('product/delete/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct');
    Route::get('invoices',[InvoiceController::class,'productInvoice'])->name('productInvoices');
    Route::get('invoices/{invoice}', [InvoiceController::class,'show'])->name('invoices.show');
    Route::get('invoices/delete/{id}', [InvoiceController::class,'destroy'])->name('invoices.delete');


    Route::get('product-category',[CategoryController::class,'productCategory'])->name('productCategory');
    Route::get('product-category/create',[CategoryController::class,'createProductCategory'])->name('createProductCategory');
    Route::post('product-category/save',[CategoryController::class,'saveProductCategory'])->name('saveProductCategory');
    Route::get('product-category/edit/{id}',[CategoryController::class,'editProductCategory'])->name('editProductCategory');
    Route::post('product-category/edit/{id}',[CategoryController::class,'updateProductCategory'])->name('updateProductCategory');
    Route::get('product-category/delete/{id}',[CategoryController::class,'deleteProductCategory'])->name('deleteProductCategory');
    Route::post('product/return/',[CategoryController::class,'productReturn'])->name('productReturn');
});



Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');

require __DIR__.'/auth.php';
