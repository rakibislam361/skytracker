@extends('backend.layouts.app')

@section('title', __('Manage Invoice'))

@section('content')
<x-backend.card>
  <x-slot name="header">
    @lang('Manage Invoice')
  </x-slot>
  <x-slot name="body">
    <livewire:backend.invoices-table />
  </x-slot>
</x-backend.card>
@endsection