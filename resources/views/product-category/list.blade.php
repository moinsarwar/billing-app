@extends('layouts.app')

@section('title')
    <title>Product Category</title>
@endsection
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Product Category') }}
    </h2>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="content-wrapper">
                        <div class="content container mt-4">
                            <a class="btn btn-warning btn-lg mb-3" href="{{ route('createProductCategory') }}">Create
                                Product
                                Category</a>
                            <table class="table table-bordered text-center mt-4" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Category Name</th>
                                    <th>Product Category Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td><img src="{{ asset('storage/' .$category->category_image) }}" width="50"></td>
                                        <td>
                                            <a class="btn btn-info"
                                               href="{{route('editProductCategory',['id' => $category->id]) }}">Edit</a>
                                            <a class="btn btn-danger"
                                               href="{{route('deleteProductCategory',['id' => $category->id]) }}">Delete</a>
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
