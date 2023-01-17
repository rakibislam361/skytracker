@extends('backend.layouts.app')

@section('title', __('Manage booking'))

@section('content')
<x-backend.card>
    <x-slot name="header">
        @lang('Manage booking')
    </x-slot>
    <x-slot name="headerActions">
        <x-utils.link :href="route('admin.booking.create')" icon="fas fa-plus" class="btn btn-sm btn-secondary" :text="__('Create Booking')" />
    </x-slot>
    <x-slot name="body">
        <livewire:backend.bookings-table />
    </x-slot>
</x-backend.card>
@endsection