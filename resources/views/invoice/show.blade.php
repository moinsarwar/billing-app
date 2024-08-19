@extends('layouts.app')

@section('title')
    <title>Invoice Details</title>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" id="invoiceDetails">
                    <h2>Invoice Details</h2>
                    <p><strong>Bill ID:</strong> {{ $bill->bill_id }}</p>
                    <p><strong>Date:</strong> {{ $bill->created_at }}</p>
                    <p><strong>Total Amount:</strong> {{ $bill->total_amount }}</p>

                    <h3>Purchased Products</h3>
                    <table class="table table-bordered text-center mt-4">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($billItems as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_size }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->total_amount }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4"><strong>Total:</strong></td>
                            <td><strong>{{ $bill->total_amount }}</strong></td>
                        </tr>
                        </tfoot>
                    </table>

{{--                    <div class="mt-4">--}}
{{--                        <button class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function printInvoice() {
            let printContents = document.getElementById('invoiceDetails');
            if (printContents !== null) {
                let originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents.innerHTML;
                window.print();
                document.body.innerHTML = originalContents;
            } else {
                console.error('Element with ID "invoiceDetails" not found.');
            }
        }
    </script>
@endsection
