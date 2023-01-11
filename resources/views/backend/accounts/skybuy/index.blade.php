@extends('backend.layouts.app')

@section('title', __('Manage Accounts'))

@section('content')

    <div>
        <div class="text-right">
            <x-utils.link :href="route('admin.account.skybuytable')" class="btn btn-sm btn-secondary" style="margin-bottom:5px" data-toggle="tooltip"
                title="SkyBuy Accounts Table" :text="__('SkyBuy Accounts')" />
        </div>

        <div class="conainer-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalcount }}</h3>
                            <p>Total Items</p>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $processing }}</h3>

                            <p>Processing</p>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $purchased }}</h3>

                            <p>Purchased</p>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $delivered }}</h3>

                            <p>Delivered</p>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
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
