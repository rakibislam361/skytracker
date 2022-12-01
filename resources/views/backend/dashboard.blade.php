@extends('backend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

<x-backend.card>
    <x-slot name="header">
    </x-slot>

    <x-slot name="body">
        @include('backend.content.order.includes.filter')
    </x-slot>
</x-backend.card>

@endsection
