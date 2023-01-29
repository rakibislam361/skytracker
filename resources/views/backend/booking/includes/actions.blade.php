<x-utils.edit-button :href="route('admin.booking.edit', $booking)" />

<button type="button" class="btn btn-outline-primary" data-value="{{ $booking }}" id="generateInvoiceButton"
    data-toggle="tooltip" title="Generate Invoice">
    @lang('Generate')
</button>

<x-utils.delete-button :href="route('admin.booking.destroy', $booking)" />
