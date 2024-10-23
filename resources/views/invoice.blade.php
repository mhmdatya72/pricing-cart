@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Select Products</h2>
    <form id="invoiceForm" action="{{ route('generate.invoice') }}" method="POST">
        @csrf
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>Select</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Weight (kg)</th>
                    <th>Shipped from</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $product->id }}" id="product{{ $product->id }}">
                            <label class="form-check-label" for="product{{ $product->id }}"></label>
                        </div>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->weight }}</td>
                    <td>{{ $product->country }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Generate Invoice</button>
        </div>
    </form>
</div>

<!-- Modal to display the invoice -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="invoiceResult">
                <!-- Invoice content will be inserted here dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Custom styles for better layout -->
<style>
    .table {
        margin-bottom: 40px;
    }

    .table-bordered {
        border: 2px solid #ddd;
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
        /* Light gray on hover */
    }

    .table-success {
        background-color: #28a745;
        /* Green for table header */
        color: white;
    }

    .form-check-input {
        margin-left: 0;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

</style>

<!-- Display the invoice after calculating -->
<script>
    document.getElementById('invoiceForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch("{{ route('generate.invoice') }}", {
                method: 'POST'
                , body: formData
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                let invoiceHtml = `
                <h3 class="mb-4">Invoice Summary</h3>
                <ul class="list-unstyled">
                    <li><strong>Subtotal:</strong> $${data.subtotal.toFixed(2)}</li>
                    <li><strong>Shipping:</strong> $${data.shipping.toFixed(2)}</li>
                    <li><strong>VAT:</strong> $${data.vat.toFixed(2)}</li>
                    <li><strong>Discounts:</strong> -$${data.discounts.toFixed(2)}</li>
                    <li><strong>Total:</strong> <span class="text-success">$${data.total.toFixed(2)}</span></li>
                </ul>
                `;
                document.getElementById('invoiceResult').innerHTML = invoiceHtml;

                // Show the modal
                var invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
                invoiceModal.show();
            })
            .catch(error => console.error('Error:', error));
    });

</script>
@endsection
