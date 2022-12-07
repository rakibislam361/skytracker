@extends('backend.layouts.app')

@section('title', __('Manage Accounts'))

@section('content')

<div>
  <div class="text-right">
   <x-utils.link :href="route('admin.account.skybuyAccountsTable')" class="btn btn-sm btn-secondary" :text="__('SkyBuy Accounts')" />
</div>

<div class="row">
   @include('backend.accounts.skybuy.includes.skybuychart')
</div>

<div class="row">
  @include('backend.accounts.skybuy.includes.recentOrders')
  @include('backend.accounts.skybuy.includes.latestReturns')  
</div>
</div>


@endsection