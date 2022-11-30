@extends('backend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

<x-backend.card>
    <x-slot name="header">
        @include('backend.content.order.includes.filter')
    </x-slot>

    <x-slot name="body">
        {{-- @lang('Welcome to the Dashboard') --}}

    </x-slot>
</x-backend.card>


@endsection