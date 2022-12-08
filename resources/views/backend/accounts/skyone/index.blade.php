@extends('backend.layouts.app')

@section('title', __('Manage Accounts'))

@section('content')

<div>
  <div class="text-right">
    <x-utils.link :href="route('admin.account.skyonetable')" class="btn btn-sm btn-secondary" :text="__('SkyOne Accounts')" />
  </div>

  <div class="row">
    @include('backend.accounts.skyone.includes.skyonechart')
  </div>

  <div class="row">
    @include('backend.accounts.skyone.includes.recentOrders')
    @include('backend.accounts.skyone.includes.latestReturns')
  </div>
</div>


@endsection