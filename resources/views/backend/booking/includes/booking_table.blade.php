<div class="table-responsive">
    <table class="table table-hover table-bordered mb-0 order-table table-striped" id="tableSelected">
        <thead>
            <tr>
                <th class="align-content-center text-center">Select<input type="checkbox" id="allSelectCheckboxBook"
                        name="allSelectCheckboxBook"></th>
                <th class="align-content-center text-center">Date</th>
                <th class="align-content-center text-center">Customer</th>
                <th class="align-content-center text-center">Phone</th>
                <th class="align-content-center text-center">Product</th>
                <th class="align-content-center text-center">Quantity</th>
                <th class="align-content-center text-center">CBM</th>
                <th class="align-content-center text-center">Carton QTY</th>
                <th class="align-content-center text-center">Shipping Mark</th>
                <th class="align-content-center text-center">Carton Number</th>
                <th class="align-content-center text-center">Shipping Number</th>
                <th class="align-content-center text-center">Tracking Number</th>
                <th class="align-content-center text-center">Actual Weight</th>
                <th class="align-content-center text-center">Unit Price</th>
                <th class="align-content-center text-center">Amount</th>
                <th class="align-content-center text-center">Remarks</th>
                <th class="align-content-center text-center">Status</th>

                <th class="align-content-center text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                @php
                    $amount = 0;
                    $weight = $booking->actual_weight ?? null;
                    $price = $booking->unit_price ?? null;
                    $amount = $weight * $price ?? null;
                @endphp
                <tr data-value="{{ $booking }}">
                    <td class="align-content-center text-center"><input type="checkbox" class="checkboxItemBook"
                            name="checkboxItemBook" id="checkboxItemBook" data-value="{{ $booking }}"
                            value={{ $booking->id ?? 'N/A' }}></td>
                    <td class="align-content-center text-center">
                        {{ $booking->created_at ? date('d/m/Y', strtotime($booking->date)) : 'N/A' }}
                    </td>
                    <td class="align-content-center text-center">{{ $booking->customer_name ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->customer_phone ?? 'N/A' }}</td>

                    <td class="align-content-center text-center">{{ $booking->othersProductName ?? 'N/A' }}</td>
                    <td class="align-content-center text-center"> {{ $booking->productQuantity ?? 'N/A' }} </td>
                    <td class="align-content-center text-center">{{ $booking->totalCbm ?? 'N/A' }}</td>


                    <td class="align-content-center text-center">{{ $booking->ctnQuantity ?? 'N/A' }}</td>


                    <td class="align-content-center text-center">{{ $booking->shipping_mark ?? 'N/A' }}
                    </td>

                    <td class="align-content-center text-center">{{ $booking->cartons->carton_number ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->shipping_number ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->tracking_number ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->actual_weight ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->unit_price ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $amount ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->remarks ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $booking->status ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">
                        <x-utils.edit-button :href="route('admin.booking.edit', $booking)" />

                        <x-utils.delete-button :href="route('admin.booking.destroy', $booking)" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($bookings != null)
        {{ $bookings->withQueryString()->links() }}
    @endif
</div>
