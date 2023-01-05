@extends('backend.layouts.app')

@section('title', __('Manage booking'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Manage booking')
        </x-slot>
        <x-slot name="body">
            <livewire:backend.bookings-table />
        </x-slot>
    </x-backend.card>
@endsection
