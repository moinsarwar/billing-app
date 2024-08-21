@extends('layouts2.app')

@section('title')
    <title>Garment Billing System</title>
@endsection

@section('content')
    <div class="content-wrapper" style="margin-top: 5rem; margin-right: 2rem; margin-left: 2rem;">
        <div class="row">
            <div class="col-md-6">
                <h2>Products</h2>
                <table class="table" id="myTable" data-order='[[0, "desc"]]'>
                    <thead>
                    <tr>
                        <th>Product Detail</th>
                        <th>Price</th>
                        <th>Off Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr id="product-{{ $product->id }}" data-id="{{ $product->id }}"data-size="{{ $product->size }}" data-name="{{ $product->name }}" data-price="{{ $product->sale_price }}" data-off-price="{{ $product->off_price }}">
                            <td>
                                <ul>
                                    <li>SKU:<b>{{ $product->category->id}}{{ $product->id }}</b></li>
                                    <li>Product Name:<b>{{ $product->name }}</b>&nbsp;&nbsp;&nbsp; <img src="{{ asset('storage/' . $product->product_image) }}" width="50"></li>
                                    @if($product->category->name === 'T-Shirt' || $product->category->name === 'Casual Shirt')
                                        <li>Size: <b>{{ $product->size }}</b></li>
                                    @endif
                                    @if($product->category->name === 'Dress Shirt')
                                        <li>Neck Size: <b>{{ $product->size }}</b></li>
                                    @endif
                                    @if($product->category->name === 'Jean Pant' || $product->category->name === 'Cotton Jean Pant' || $product->category->name === 'Dress Pant')
                                        <li>Waist Width: <b>{{ $product->size }}</b></li>
                                    @endif
                                    <li>Quantity: <b class="quantity">{{ $product->quantity > 0 ? $product->quantity : 'Out of stock' }}</b></li>
                                </ul>
                            </td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->off_price }}</td>
                            <td><i class="fa-sharp fa-solid fa-plus add-to-cart" style="cursor:pointer;"></i></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Cart</h2>
                <div id="bill"></div>
                <table class="table" id="cart-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><strong>Total:</strong></td>
                        <td id="cart-total">0</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
                <button id="print-bill-btn" class="btn btn-primary">Print Bill</button>
            </div>
        </div>
    </div>

    <input type="hidden" id="bill-id-input" value="">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('myTable').addEventListener('click', function (event) {
                if (event.target.classList.contains('add-to-cart')) {
                    let row = event.target.closest('tr');
                    let productId = row.getAttribute('data-id');
                    let productName = row.getAttribute('data-name');
                    let productPrice = parseFloat(row.getAttribute('data-price'));
                    let productSize = row.getAttribute('data-size') || ''; // Get the size from the row
                    let offPrice = parseFloat(row.getAttribute('data-off-price')) || 0;
                    let quantityElement = row.querySelector('.quantity');
                    let quantity = parseInt(quantityElement.innerText);

                    if (quantity > 0) {
                        addToCart(productId, productName, productPrice, offPrice , productSize);
                        quantityElement.innerText = quantity - 1;
                    } else {
                        // alert('Product is out of stock');
                        Swal.fire({
                            icon: 'error',
                            title: 'Out of Stock',
                            text: 'This Product is out of stock',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });

            document.getElementById('print-bill-btn').addEventListener('click', function () {
                let billId = generateRandomBillId();
                document.getElementById('bill-id-input').value = billId;
                printBill();
                sendCartData(billId); // Send cart data along with the generated billId
            });

            document.getElementById('cart-table').addEventListener('click', function (event) {
                if (event.target.classList.contains('delete-item')) {
                    let row = event.target.closest('tr');
                    let productName = row.cells[0].innerText;
                    row.remove();
                    updateCartTotal();
                    let productRow = document.querySelector(`#myTable tr[data-name="${productName}"]`);
                    if (productRow) {
                        let quantityElement = productRow.querySelector('.quantity');
                        let quantity = parseInt(quantityElement.innerText);
                        quantityElement.innerText = quantity + 1;
                    }
                }
            });
        });
        $('#myTable').DataTable({
            "pageLength": 3,
            "dom": 'ftp',
            order: [[0, 'desc']]
        });
        function addToCart(productId, productName, productPrice, offPrice , productSize) {
            let finalPrice = offPrice ? (productPrice - offPrice) : productPrice;
            let cartTableBody = document.querySelector('#cart-table tbody');
            let existingProductRow = cartTableBody.querySelector(`tr[data-id="${productId}"]`);

            if (existingProductRow) {
                let quantityCell = existingProductRow.querySelector('.quantity');
                let quantity = parseInt(quantityCell.innerText);
                quantityCell.innerText = quantity + 1;
            } else {
                let newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>${productName}</td>
                <td>${productSize}</td>
                <td>${finalPrice.toFixed(2)}</td>
                <td class="quantity">1</td>
                <td><i class="fa-solid fa-trash delete-item"></i></td>`;
                newRow.setAttribute('data-id', productId);
                cartTableBody.appendChild(newRow);
            }

            updateCartTotal();
        }

        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('#cart-table tbody tr').forEach(function (row) {
                let price = parseFloat(row.cells[2].innerText);
                let quantity = parseInt(row.cells[3].innerText);
                total += price * quantity;
            });
            document.getElementById('cart-total').innerText = total.toFixed(2);
        }

        function generateRandomBillId() {
            return 'PJ-' + Math.floor(Math.random() * 1000000);
        }

        function printBill() {
            let billId = document.getElementById('bill-id-input').value; // Get the generated bill_id
            let date = new Date();
            let formattedDate = date.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });

            let billContent = `
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #f8f9fa;
                }
                .bill-container {
                    width: 60%;
                    background: white;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    overflow-x: auto;
                }
                .bill-header {
                    text-align: center;
                    padding: 20px;
                }
                .bill-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                    table-layout: fixed;
                }
                .bill-table th, .bill-table td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: center;
                    word-wrap: break-word;
                }
                .bill-table th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                .bill-total {
                    font-weight: bold;
                    font-size: 1.2em;
                }
            </style>
            <div class="bill-container">
                <div class="bill-header" style="color: red; background-color: yellow">
                    <h1>Peer Gee Kurta</h1>
                </div>
                <div style="margin-bottom: 10px; margin-top: 10px;">
                    <p><b>Date</b>: ${formattedDate}</p>
                    <p id="billId"><b>Bill</b> # ${billId}</p>
                </div>
                <table class="bill-table">
                    <thead>
                        <tr>
                            <th>S#</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>`;

            let totalAmount = 0;
            let serialNumber = 1;

            document.querySelectorAll('#cart-table tbody tr').forEach(function (row) {
                let productName = row.cells[0].innerText;
                let productSize = row.cells[1].innerText;
                let productPrice = parseFloat(row.cells[2].innerText);
                let quantity = parseInt(row.cells[3].innerText);
                let productTotal = productPrice * quantity;
                totalAmount += productTotal;

                billContent += `<tr>
                <td><small>${serialNumber}</small></td>
                <td><small>${productName}</small></td>
                <td><small>${productSize}</small></td>
                <td><small>${productPrice.toFixed(2)}</small></td>
                <td><small>${quantity}</small></td>
                <td><small>${productTotal.toFixed(2)}</small></td>
            </tr>`;
                serialNumber++;
            });

            billContent += `</tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"><strong>Total:</strong></td>
                            <td class="bill-total">${totalAmount.toFixed(2)}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>`;

            let printWindow = window.open('', '_blank', 'width=600,height=600');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Bill</title></head><body>');
            printWindow.document.write(billContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function sendCartData(billId) {
            let cartData = [];
            document.querySelectorAll('#cart-table tbody tr').forEach(function (row) {
                let productId = row.getAttribute('data-id');
                let productName = row.cells[0].innerText;
                let productSize = row.cells[1].innerText;
                let price = parseFloat(row.cells[2].innerText);
                let quantity = parseInt(row.cells[3].innerText);
                cartData.push({ id: productId, name: productName, price: price, quantity: quantity , size:productSize   });
            });

            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                url: '{{ route("add.to.cart") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: { cart: cartData, bill_id: billId }, // Send the bill_id along with cart data
                success: function(response) {
                    if (response.success) {
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        setTimeout(function() {
            location.reload();
        }, 600000);
    </script>

@endsection
