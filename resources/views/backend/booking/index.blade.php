@extends('backend.layouts.app')

@section('title', __('Manage booking'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Manage booking')
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
            <div style="padding-bottom: 20px;">
                @include('backend.booking.includes.booking_filter')
            </div>
            {{-- <livewire:backend.bookings-table /> --}}
            @include('backend.invoice.generate-modal')
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
@endsection
