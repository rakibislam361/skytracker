<x-utils.edit-button :href="route('admin.booking.edit', $booking)" />
<x-utils.delete-button :href="route('admin.booking.destroy', $booking)" />
<a href="{{ route('admin.booking.show', $booking) }}" class="btn btn-primary" style="margin: 2px;">Invoice</a>
