@extends('backend.layouts.app')

@section('title', 'Recent Orders')

@section('content')
    @php
        $status = request('status');
        $allOrdersCount = $orders ? $orders : null;
        $partialCount = $orders ? $orders->where('status', 'Partial Paid') : null;
        $onHold = $orders ? $orders->where('status', 'on-hold') : null;
        $icompleteCount = $orders ? $orders->where('status', 'Waiting for Payment') : null;
        $refundedCount = $orders ? $orders->where('status', 'refunded') : null;
        $processingCount = $orders ? $orders->where('status', 'processing') : null;
        $purchasedCount = $orders ? $orders->where('status', 'purchased') : null;
    @endphp
    @if ($logged_in_user->hasAllAccess())
    @include('backend.content.order.includes.filter')
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="d-inline-block mr-2">@lang('Recent Orders')</h5>
            <div class="status-control">
                <a href="{{ route('admin.order.index') }}" class="@if (!$status) active @endif">
                    @lang('All Orders') ({{ $allOrdersCount }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'bd-order']) }}"
                    class="@if ($status == 'Partial Paid') active @endif">
                    @lang('BD Order') ({{ $partialCount }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'china-purchase']) }}"
                    class="@if ($status == 'on-hold') active @endif">
                    @lang('China Purchase') ({{ $onHold }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'china-warehouse']) }}"
                    class="@if ($status == 'Waiting for Payment') active @endif">
                    @lang('China Warehouse') ({{ $icompleteCount }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'bd-warehouse']) }}"
                    class="@if ($status == 'refunded') active @endif">
                    @lang('BD Warehouse') ({{ $refundedCount }})
                </a>
                @hasrole('administrator')
                    <a href="{{ route('admin.order.index', ['status' => 'trashed']) }}"
                        class="@if ($status == 'trashed') active @endif">
                        @lang('Trashed Orders') ({{ $trashedOrders }})
                    </a>
                @endhasrole
            </div>
        </div>
      <div class="card-body">  
 
            @include('backend.content.order.includes.order_table')

        </div> <!-- card-body-->
    </div> <!-- card-->

    <!-- Modal -->
     @include('backend.content.order.includes.edit_modal')


    {{-- @include('backend.content.order.wallet.includes.generate-modal') --}}


@endsection


{{-- @push('before-styles')
    {{ style('assets/plugins/select2/css/select2.min.css') }}
    {{ style('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}
@endpush --}}

{{-- @push('after-styles')
    @livewireStyles
@endpush --}}

{{-- @push('middle-scripts')
    {{ script('assets/plugins/select2/js/select2.full.min.js') }}
    @livewireScripts

    {!! script('assets/js/manage-wallet.js') !!}
@endpush --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    function orderModal(data) {
        // console.log(data);
      $("#changeStatusButton").modal('show');
            $('#ItemNo').val(data.order_number);
    }
</script> --}}
     {{-- <script>
       $('#changeStatusButton').on('click', '.orderClass', function() {
        let ab = $('#id').val($(this).attr('data-id'));
        console.log(ab);
        $('#changeStatusButton').modal('show');
     });
    </script> --}}

{{-- <script>
  $(document).ready(function() {
    $('#changeStatusButton').modal('show');
  });
</script> --}}
