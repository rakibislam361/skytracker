@extends('frontend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

    <div class="card">
        <div class="card-header">
            <h2>My Invoices</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 order-table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th>Delivery Method</th>
                            <th>Payment Method</th>
                            <th>Courier Bill</th>
                            <th>China Local Delivery</th>
                            <th>Packing Cost</th>
                            <th>Total Amount</th>
                            <th>Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice as $book)
                        
                            <tr>
                                <td>{{ $book->created_at ? date('d/m/Y', strtotime($book->created_at)) : 'N/A' }}</td>
                                <td><a href="{{ route('frontend.user.invoices.details', $book->id) }}"
                                        target="_blank">{{ $book->invoice_id ?? 'N/A' }}</a>
                                </td>
                                <td>{{ $book->delivery_method ?? 'N/A' }}</td>
                                <td>{{ $book->payment_method ?? 'N/A' }}</td>
                                <td>{{ $book->total_courier ?? 'N/A' }}</td>
                                <td>{{ $book->chinalocal ?? 'N/A' }}</td>
                                <td>{{ $book->packing_cost ?? 'N/A' }}</td>
                                <td>{{ $book->amount ?? 'N/A' }}</td>
                                <td>{{ $book->paid ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($invoice != null)
                    {{ $invoice->withQueryString()->links() }}
                @endif
            </div>
        </div>
    </div>

@endsection
