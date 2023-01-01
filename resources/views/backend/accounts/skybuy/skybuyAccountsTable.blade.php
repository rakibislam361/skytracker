@extends('backend.layouts.app')

@section('title', __('Account Table'))

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="skybuytable" style="color: gray;">
                <h5 class="d-inline-block mr-2">@lang('SkyBuy Account')</h5>
            </a>

            <a href="{{ route('admin.account.skybuy') }}" class="btn btn-sm btn-secondary float-right" data-toggle="tooltip"
                title="SkyBuy Dashboard">
                <i class="fa fa-arrow-left">Back</i>
            </a>
            @include('backend.accounts.includes.acc_filter')

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table-striped">
                    <thead>
                        <tr>
                            <th class="align-content-center text-center">Date</th>
                            <th class="align-content-center text-center">Item Number</th>
                            <th class="align-content-center text-center">Customer</th>
                            <th class="align-content-center text-center">BD Receive</th>
                            <th class="align-content-center text-center">BD Out</th>
                            <th class="align-content-center text-center">Status</th>
                            <th class="align-content-center text-center">Profit/Loss</th>
                            <th class="align-content-center text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <span class="badge badge-success float-right" style="font-size: 100%; margin-bottom: 10px;">Profit =
                            {{ $total }}</span>
                        @foreach ($accounts as $account)
                            @php
                                $bdReceive = $account->product_bd_received_cost;
                                $bdOut = $account->purchase_cost_bd;
                                $pl = $bdReceive - $bdOut;
                            @endphp

                            <tr>
                                <td class="align-content-center text-center">
                                    {{ $account->created_at ? date('d/m/Y', strtotime($account->created_at)) : 'N/A' }}</td>
                                <td class="align-content-center text-center">{{ $account->order_item_number ?? 'N/A' }}</td>
                                <td class="align-content-center text-center">{{ $account->user->name ?? 'N/A' }}</td>

                                <td class="align-content-center text-center">
                                    {{ $bdReceive ?? 'N/A' }}</td>
                                <td class="align-content-center text-center">{{ $bdOut ?? 'N/A' }}</td>
                                <td class="align-content-center text-center">{{ $account->status ?? 'N/A' }}</td>
                                <td class="align-content-center text-center">{{ $pl ?? 'N/A' }}</td>
                                <td class="align-content-center text-center"><a href="#"
                                        class="btn btn-secondary btn-sm"><i class="fa fa-file"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="mt-4">
                {{ $accounts->links() }}
            </div>

        </div> <!-- card-body-->
    </div>





@endsection
