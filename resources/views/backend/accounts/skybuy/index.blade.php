@extends('backend.layouts.app')

@section('title', __('Manage Accounts'))

@section('content')
    @php
        $acc = [];
        $totalcount = 0;
        $waiting = 0;
        $processing = 0;
        $delivered = 0;
        $purchased = 0;
        $pending = 0;
        foreach ($accounts as $data) {
            $acc[] = $data;
            $count = count($acc);
            $totalcount += $count;
        }
        foreach ($accounts as $data) {
            if ($data->status == 'Waiting for Payment') {
                $acc[] = $data;
                $count = count($acc);
                $waiting += $count;
            }
        }
        foreach ($accounts as $data) {
            if ($data->status == 'processing') {
                $acc[] = $data;
                $count = count($acc);
                $processing += $count;
            }
        }
        foreach ($accounts as $data) {
            if ($data->status == 'delivered') {
                $acc[] = $data;
                $count = count($acc);
                $delivered += $count;
            }
        }
        foreach ($accounts as $data) {
            if ($data->status == 'purchased') {
                $acc[] = $data;
                $count = count($acc);
                $purchased += $count;
            }
        }
        foreach ($accounts as $data) {
            if ($data->status == 'on-hold') {
                $acc[] = $data;
                $count = count($acc);
                $pending += $count;
            }
        }
        // dd($totalcount);
    @endphp

    <div>
        <div class="text-right">
            <x-utils.link :href="route('admin.account.skybuytable')" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                title="SkyBuy Accounts Table" :text="__('SkyBuy Accounts')" />
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
