@extends('backend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

<x-backend.card>
    <x-slot name="header">
        <a class="btn btn-primary btn-lg" href="{{route('admin.booking.create')}}"><i class="fa fa-calendar-plus"></i> ADD LOCAL BOOKING</a>
    </x-slot>

    <x-slot name="body">
        @include('backend.content.order.includes.filter')
    </x-slot>
</x-backend.card>

@endsection