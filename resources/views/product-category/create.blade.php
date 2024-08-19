@extends('layouts.app')

@section('title')
    <title>Create Product Category</title>
@endsection
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create Product Category') }}
    </h2>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="content-wrapper">
                        @if($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <div class="content container mt-4">
                            <form method="post" enctype="multipart/form-data" action="{{route('saveProductCategory')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Product Category Name</label>
                                        <input type="text" name="product_category_name" class="form-control" ? required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Product Category Image</label>
                                        <input type="file" name="product_category_image" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

