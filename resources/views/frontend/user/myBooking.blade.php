@extends('frontend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

    <div class="card">
        <div class="card-header">
            <h2>Booking Details</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 order-table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Product Qty</th>
                            <th>Carton Qty</th>
                            <th>Weight</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($booking as $book)
                            <tr>
                                <td>{{ $book->date ? date('d/m/Y', strtotime($book->date)) : 'N/A' }}</td>
                                <td>{{ $book->othersProductName ?? 'N/A' }}</td>
                                <td>{{ $book->productQuantity ?? 'N/A' }}</td>
                                <td>{{ $book->ctnQuantity ?? 'N/A' }}</td>
                                <td>{{ $book->actual_weight ?? 'N/A' }}</td>
                                <td>{{ $book->amount ?? 'N/A' }}</td>
                                <td>{{ $book->paid ?? 'N/A' }}</td>
                                <td>{{ $book->status ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
