@extends('layouts.app')

@section('title')
    <title>Product</title>
@endsection
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Product') }}
    </h2>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="content-wrapper">
                        <div class="content container mt-4">
                            <a class="btn btn-warning btn-lg mb-3" href="{{ route('createProduct') }}">Create
                                Product</a>
                            <table class="table table-bordered text-center mt-4" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Product Photo</th>
                                    <th>Size</th>
{{--                                    <th>Neck Size</th>--}}
{{--                                    <th>Waist Width</th>--}}
                                    <th>Purchase Price</th>
                                    <th>Sale Price</th>
                                    <th>Off Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->quantity }}</td>
{{--                                        <td><img src="{{ getImageUrl($product->product_image) }}" width="50"></td>--}}
                                        <td><img src="{{ asset('storage/' . $product->product_image) }}" width="50"></td>
                                        </td>
                                        <td>{{ $product->size ? : 'N/A'}}</td>
{{--                                        <td>{{ $product->neck_size ? : 'N/A'}}</td>--}}
{{--                                        <td>{{ $product->waist_width ? : 'N/A' }}</td>--}}

                                        <td>{{ $product->purchase_price}}</td>
                                        <td>{{ $product->sale_price}}</td>
                                        <td>{{ $product->off_price}}</td>
                                        <td>
                                            <a class="btn btn-info"
                                               href="{{route('editProduct',['id' => $product->id]) }}">Edit</a>
                                            <a class="btn btn-danger"
                                               href="{{route('deleteProduct',['id' => $product->id]) }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script>
                let table = $('#myTable').DataTable({
                    "dom": 'ftp',
                });
            </script>
@endsection

