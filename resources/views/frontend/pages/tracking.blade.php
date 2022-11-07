@include('frontend.style.style')
@include('frontend.content.header')
@include('frontend.auth.login')
@include('frontend.content.banner')
@include('frontend.content.trackproduct')
@extends('frontend.layouts.app')
@section('title', __('_tracking'))
@section('content')

<div class="container py-4">
  <div class="row justify-content-center shadow">
    <div class="col-md-12">
      <x-frontend.card>
        <x-slot name="body">
          {{-- search product details and status start   --}}
          <div class="">
            @forelse($data as $track)
            <div class="table-responsive">
              <table class="table table-hover table-bordered mb-0">
                <tr>
                  <h3 style="margin-left: 20%">Your Searched Product Details</h3>
                </tr>

                <tr>
                  <th>@lang('Invoice')</th>
                  <td>{{ $track->invoice }}</td>
                </tr>

                <tr>
                  <th>@lang('Product Name')</th>

                  <?php $p_name = json_decode($track->productName, true); ?>

                  <td>
                    @foreach($p_name as $pName)
                    {{$pName}},
                    @endforeach
                  </td>

                </tr>

                <tr>
                  <th>@lang('Shipping Type')</th>
                  <td>{{ $track->shipping_type }}</td>
                </tr>

                <tr>
                  <th>@lang('Status')</th>
                  <td>{{ $track->status }}</td>
                </tr>

                <tr>
                  <th>@lang('Warehouse')</th>
                  <td>{{ $track->warehouse_id }}</td>
                </tr>

              </table>
            </div>
            @empty
            <table class="table table-striped table-hover table-bordered mb-0">
              <tr>
                <td>
                  <h3 style="margin-left: 30%">Sorry!!! Nothing Found</h3>
                </td>
              </tr>
            </table>

            @endforelse

          </div>

          {{-- search product details and status end   --}}

        </x-slot>
      </x-frontend.card>
    </div>
    <!--col-md-10-->
  </div>
  <!--row-->
</div>
@include('frontend.content.footer')

@endsection