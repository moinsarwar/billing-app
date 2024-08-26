@extends('layouts.app')

@section('title')
    <title>Invoices</title>
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Invoices') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Daily Sales Card -->
                        <div class="bg-blue-100 border-l-4 border-blue-500 p-4">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">{{ date('Y-m-d') }} Total Sales</div>
                            </div>
                            <div class="ml-4 mt-4 text-2xl font-semibold text-blue-700">{{ $dailySales }}</div>
                        </div>

                        <!-- Invoices Table -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="content-wrapper">
                                    <div class="content container mt-4">
                                        <table class="table table-bordered text-center mt-4" id="myTable">
                                            <thead>
                                            <tr>
                                                <th>Bill ID</th>
                                                <th>Date</th>
                                                <th>Total Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->bill_id }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($invoice->created_at)->isoFormat('Do MMMM YYYY') }}
                                                    </td>
                                                    <td>{{ $invoice->total_amount }}</td>
                                                    <td>
                                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-warning">View</a>
                                                        <a href="{{ route('invoices.delete', $invoice->id) }}" class="btn btn-danger">Delete</a>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[1, 'desc']],
                "dom": 'ftp'
            });
        });
    </script>
@endsection
