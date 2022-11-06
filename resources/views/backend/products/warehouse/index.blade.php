@extends('backend.layouts.app')

@section('title', __('Manage warehouses'))

@section('content')
<x-backend.card>
  <x-slot name="header">
    @lang('Manage warehouses')
  </x-slot>
  <x-slot name="body">
    <livewire:backend.warehouses-table />
  </x-slot>
</x-backend.card>
@endsection