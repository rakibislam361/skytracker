@include('frontend.style.style')
@include('frontend.content.header')
@include('frontend.auth.login')
@include('frontend.content.banner')
@include('frontend.content.trackproduct')
@extends('frontend.layouts.app')

@section('content')
<div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <x-frontend.card>
        <x-slot name="body">
          {{-- search product details and status start   --}}
          <div class="content-justify-center shadow">

            @forelse($data as $track)
            <div class="table-responsive">
              <table class="table table-striped table-hover table-bordered mb-0">
                <tr>
                  <h3 style="margin-left: 33%">Your Searched Product Details</h3>
                </tr>
                <tr>
                  <th>@lang('ID')</th>
                  <td>{{ $track->id }}</td>
                </tr>
                <tr>
                  <th>@lang('Product Name')</th>
                  <td>{{ $track->name }}</td>
                </tr>
                <tr>
                  <th>@lang('Shipping Type')</th>
                  <td>{{ $track->shipping_type }}</td>
                </tr>

              </table>
            </div>
            @empty
            <table class="table table-striped table-hover table-bordered mb-0">
              <tr>
                <td>
                  <h3 style="margin-left: 25%">Sorry!!! Nothing Found</h3>
                </td>
              </tr>
            </table>

            @endforelse

          </div>
          {{-- search product details and status end   --}}
          @include('frontend.content.footer')
        </x-slot>
      </x-frontend.card>
    </div>
    <!--col-md-10-->
  </div>
  <!--row-->
</div>


@endsection