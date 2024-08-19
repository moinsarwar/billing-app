@extends('layouts.app')

@section('title')
    <title>Create Product</title>
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create Product') }}
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
                            <form method="post" enctype="multipart/form-data" action="{{route('saveProduct')}}">
                                @csrf
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label>Product Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Product Image</label>
                                        <input type="file" name="product_image" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label>Purchase Price</label>
                                        <input type="number" name="purchase_price" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Sale Price</label>
                                        <input type="number" name="sale_price" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label>Off Price</label>
                                        <input type="number" name="off_price" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6" id="category">
                                        <label>Product Category</label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="">Please Select...!</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="sizeInput">
                                        <label>Size</label>
                                        <select class="form-control size-field" name="size">
                                            <option value="">Please Select...!</option>
                                            <option value="Extra Small">Extra Small</option>
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                            <option value="Extra Large">Extra Large</option>
                                            <option value="Double Extra Large">Double Extra Large</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="neckSize">
                                        <label>Neck Size</label>
                                        <input type="number" class="form-control size-field" name="size">
                                    </div>
                                    <div class="col-md-6" id="waistInput">
                                        <label>Waist Width</label>
                                        <input type="number" class="form-control size-field" name="size">
                                    </div>
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
            <script>
                // Define the category names with corresponding IDs
                var categoryNames = {
                    @foreach($categories as $category)
                    '{{ $category->id }}': '{{ $category->name }}',
                    @endforeach
                };

                // Initially hide and disable all specific fields
                $('.size-field').attr('disabled', true).hide();
                $('#neckSize').hide();
                $('#sizeInput').hide();
                $('#waistInput').hide();
                // Listen for changes on the category dropdown
                document.getElementById("category_id").addEventListener("change", function () {
                    // Get the selected category ID and name
                    var selectedId = this.value;
                    var selectedName = categoryNames[selectedId];

                    // Hide and disable all size fields
                    $('.size-field').attr('disabled', true).hide();

                    // Show and enable the relevant field based on the selected category
                    if (selectedName === "T-Shirt" || selectedName === "Casual Shirt") {
                        $('#sizeInput').show();
                        $('#neckSize').hide();
                        $('#waistInput').hide();
                        $('#sizeInput select').attr('disabled', false).show();
                    } else if (selectedName === "Dress Shirt") {
                        $('#neckSize input').attr('disabled', false).show();
                        $('#neckSize').show();
                        $('#sizeInput').hide();
                        $('#waistInput').hide();
                    } else if (selectedName === "Jean Pant" || selectedName === "Cotton Jean Pant" || selectedName === "Dress Pant") {
                        $('#waistInput').show();
                        $('#neckSize').hide();
                        $('#sizeInput').hide();
                        $('#waistInput input').attr('disabled', false).show();
                    }else{
                        $('#neckSize').hide();
                        $('#sizeInput').hide();
                        $('#waistInput').hide();
                    }
                });
            </script>
@endsection
