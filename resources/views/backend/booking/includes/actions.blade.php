<x-utils.edit-button :href="route('admin.booking.edit', $booking)" />
<x-utils.delete-button :href="route('admin.booking.destroy', $booking)" />
{{-- <a href="{{ route('admin.invoice.create', $booking) }}" id="generateInvoiceButton" target="_blank" class="btn btn-primary"
    style="margin: 2px;">Generate Invoice</a> --}}
<button type="button" class="btn btn-danger" data-value="{{ $booking }}" id="generateInvoiceButton"
    data-toggle="tooltip" title="Generate Invoice">
    @lang('Generate')
</button>
