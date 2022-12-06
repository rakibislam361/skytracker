@extends('backend.layouts.app')

@section('title', __('Manage Account'))

@section('content')
<x-backend.card>
  <x-slot name="header">
    @lang('Manage Account')
  </x-slot>
  <x-slot name="body">
    <livewire:backend.products-table />
  </x-slot>
</x-backend.card>
@endsection