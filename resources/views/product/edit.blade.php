@extends('layouts.app')

@section('title')
    <title>Edit Product</title>
@endsection
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Product') }}
    </h2>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="content-wrapper">
                        @if($errors->any())
                            <p class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</p>
                        @endif
                        <div class="content container mt-4">
                            <form method="post" enctype="multipart/form-data"
                                  action="{{route('updateProduct' ,['id' => $product->id])}}">
                                @csrf
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label>Product Name</label>
                                        <input type="text" name="name" value="{{$product->name}}" class="form-control" ?
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Product Image</label>
                                        <input type="file" name="product_image" class="form-control">
                                        <img src="{{ asset('storage/' . $product->product_image) }}" width="100">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label>Purchase Price</label>
                                        <input type="number" name="purchase_price" value="{{$product->purchase_price}}"
                                               class="form-control" ?
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Sale Price</label>
                                        <input type="number" name="sale_price" value="{{$product->sale_price}}"
                                               class="form-control" ?
                                               required>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label>Off Price</label>
                                        <input type="number" name="off_price" value="{{$product->off_price}}"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" value="{{$product->quantity}}"
                                               class="form-control" ?
                                               required>
                                    </div>
                                </div>
                                <div class="row mt-4">

                                    <div class="col-md-6">
                                        <label>Product Category</label>
                                        <select class="form-control" name="category_id" disabled>
                                            <option value=" ">Please Select...!</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                        @if($category->id === $product->category_id) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="category_id" value="{{ $product->category_id }}">
                                    </div>
                                    @if($product->category->name === 'T-Shirt' || $product->category->name === 'Casual Shirt')
                                        <div class="col-md-6" id="sizeInput">
                                            <label>Size</label>
                                            <select class="form-control" name="size">
                                                <option value="">Please Select...!</option>
                                                <option value="Extra Small"
                                                        @if($product->size === 'Extra Small') selected @endif>Extra
                                                    Small
                                                </option>
                                                <option value="Small" @if($product->size === 'Small') selected @endif>
                                                    Small
                                                </option>
                                                <option value="Medium" @if($product->size === 'Medium') selected @endif>
                                                    Medium
                                                </option>
                                                <option value="Large" @if($product->size === 'Large') selected @endif>
                                                    Large
                                                </option>
                                                <option value="Extra Large"
                                                        @if($product->size === 'Extra Large') selected @endif>Extra
                                                    Large
                                                </option>
                                                <option value="Double Extra Large"
                                                        @if($product->size === 'Double Extra Large') selected @endif>
                                                    Double Extra Large
                                                </option>
                                            </select>
                                        </div>
                                    @endif
                                    @if($product->category->name === 'Dress Shirt')
                                        <div class="col-md-6" id="neckSize">
                                            <label>Neck Size</label>
                                            <input type="number" class="form-control" value="{{$product->size}}"
                                                   name="size">
                                        </div>
                                    @endif
                                    @if($product->category->name === 'Jean Pant' || $product->category->name === 'Cotton Jean Pant' || $product->category->name === 'Dress Pant')
                                        <div class="col-md-6" id="waistInput">
                                            <label>Waist Width</label>
                                            <input type="number" class="form-control" value="{{$product->size}}"
                                                   name="size">
                                        </div>
                                    @endif
                                </div>
                                <div class="row mt-4">

                                </div>
                                <button type="submit" class="btn btn-lg btn-success mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')


@endsection




