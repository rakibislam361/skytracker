@extends('backend.layouts.app')

@section('title', __('Manage booking'))

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css" rel="stylesheet">
    <x-backend.card>
        <x-slot name="header">
            @lang('Manage Booking')
            <span>
                <a href="{{ route('admin.booking.index') }}" class="btn btn-outline-primary"><i class="fa fa-refresh"
                        aria-hidden="true"> Refresh</i></a></span>

        </x-slot>
        <x-slot name="headerActions">
            <div class="btn-group float-right" role="group" aria-label="header_button_group">
                <button type="button" class="btn btn-primary" id="changeGroupStatusButtonBook" data-toggle="tooltip"
                    disabled="true" title="@lang('Change Status')">
                    @lang('Change Status')
                </button>
                <button type="button" class="btn btn-danger" id="InvoiceButtonBook" data-toggle="tooltip"
                    title="Generate Invoice" disabled="true">
                    @lang('Generate Invoice')
                </button>
            </div>
            <x-utils.link :href="route('admin.booking.create')" icon="fas fa-plus" class="btn btn-sm btn-secondary" :text="__('Create Booking')" />
        </x-slot>
        <x-slot name="body">
            <div style="margin-bottom: 10px;">
                @include('backend.booking.includes.booking_filter')
            </div>
            @include('backend.invoice.generate-modal')
            @php
                $count = count($bookings);
            @endphp
            <div class="badge badge-pill badge-success" style="font-size: 100%; margin-bottom: 10px;">Total
                Bookings
                : {{ $count }}</div>
            @include('backend.booking.includes.booking_table')


            <div class="modal fade" id="changeStatusButtonBook" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statusChangeFormModalLabel">Change status</h5><span
                                    class="orderId"></span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form method="post" action="{{ route('admin.booking.status.update') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="hiddenFieldBook">
                                        {{-- hidden Field --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select</option>
                                            <option value="received-in-china-warehouse">Received in china warehouse</option>
                                            <option value="shipped-from-china-warehouse">Shipped from china warehouse
                                            </option>
                                            <option value="received-in-BD-warehouse">Received in BD warehouse </option>
                                            <option value="delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary">Save
                                        changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
    @if (session()->has('Createmessage'))
        <script>
            Swal.fire({
                icon: "success",
                text: "Your Booking Order Placed Successfully",
            })
        </script>
    @endif
    @if (session()->has('Updatemessage'))
        <script>
            Swal.fire({
                icon: "success",
                text: "Booking Order Updated Successfully",
            })
        </script>
    @endif
@endsection
