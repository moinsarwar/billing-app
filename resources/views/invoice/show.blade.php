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
                            <th>Product Id</th>
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
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_size }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->total_amount }}</td>
                                <td>
                                    <button class="btn btn-danger" onclick="showReturnPopup({{ $item->id }}, {{ $item->quantity }}, {{ $item->product_id }} , {{$item->product_price}})">Return</button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5"><strong>Total:</strong></td>
                            <td><strong>{{ $bill->total_amount }}</strong></td>
                        </tr>
                        </tfoot>
                    </table>
                    <div id="returnPopup" style="display:none;">
                        <form id="returnForm" method="POST" action="{{route('productReturn')}}">
                            @csrf
                            <input type="hidden" name="item_id" id="item_id">
                            <input type="hidden" name="product_id" id="product_id">
                            <input type="hidden" name="product_price" id="product_price">
                            <label for="return_quantity">Quantity to Return:</label>
                            <input type="number" name="return_quantity" id="return_quantity" min="1">
                            <button type="submit" class="btn btn-success">Submit Return</button>
                            <button type="button" class="btn btn-danger" onclick="closeReturnPopup()">Cancel</button>
                        </form>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showReturnPopup(itemId, maxQuantity , productId ,productPrice) {
            document.getElementById('item_id').value = itemId;
            document.getElementById('product_id').value = productId;
            document.getElementById('product_price').value = productPrice;
            document.getElementById('return_quantity').setAttribute('max', maxQuantity);
            document.getElementById('returnPopup').style.display = 'block';
        }

        function closeReturnPopup() {
            document.getElementById('returnPopup').style.display = 'none';
        }
    </script>
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
