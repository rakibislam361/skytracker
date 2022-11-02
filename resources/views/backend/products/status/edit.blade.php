@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Status'))

@section('content')


<div class="row justify-content-center">
  <div class="col-md-10">

    {{ html()->modelForm($status, 'PATCH', route('admin.product.status.update',
    $status))->attribute('enctype', 'multipart/form-data')->open() }}
    @csrf
    <x-backend.card>
      <x-slot name="header">
        @lang('Update Status')
      </x-slot>

      <x-slot name="headerActions">
        <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.status.index')" :text="__('Cancel')" />
      </x-slot>

      <x-slot name="body">

        <div class="form-group">
          <label for="invoice">Invoice</label>
          <input value="{{ $status->invoice }}" readonly="readonly" name="invoice" class="form-control" />
        </div>


        <div class="form-group">
          <label for="status">Status</label>
          <select class="form group dropdown-item border" name="status">
            <option selected value="{{ $status->status }}">{{ $status->status }}</option>
            <option value="Order Placed">Order Placed</option>
            <option value="Pickup in progress">Pickup in progress</option>
            <option value="In Warehouse">In Warehouse</option>
            <option value="In Transit">In Transit</option>
            <option value="Arrived">Arrived</option>
          </select>
        </div> <!-- form-group -->



        <div class="form-group">
          <label for="warehouse">Warehouse</label>
          <select class="form group dropdown-item border" name="warehouse">
            <option selected value="{{ $status->warehouse }}">{{ $status->warehouse }}</option>
            <option value="Dhaka">DHAKA</option>
            <option value="China">CHINA</option>
            <option value="Chittagong">CHITTAGONG</option>

          </select>
        </div> <!-- form-group -->


  </div> <!-- form-group -->


  </x-slot>

  <x-slot name="footer">
    <button class="btn btn-sm btn-primary" type="submit">@lang('Update status')</button>
  </x-slot>
  </x-backend.card>

  {{ html()->closeModelForm() }}

</div>
</div>
@endsection