@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Status'))

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">

    {{ html()->modelForm($status, 'PATCH', route('admin.product.status.update',
    $status))->attribute('enctype', 'multipart/form-data')->open() }}

    <x-backend.card>
      <x-slot name="header">
        @lang('Update Status')
      </x-slot>

      <x-slot name="headerActions">
        <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.status.index')" :text="__('Cancel')" />
      </x-slot>

      <x-slot name="body">

        <div class="form-group">
          {{html()->label('Invoice')->for('invoice')}}
          {{html()->text('invoice')
          ->class('form-control')
           ->readonly('readonly')  
          ->placeholder('status')}}
        </div>


        <div class="form-group">
          {{html()->label('Status')->for('status')}}
          <select class="form group dropdown-item border" name="status">
            <option value="{{ $status->status }}">{{ $status->status }}</option>
            <option value="Order Placed">Order Placed</option>
            <option value="Pickup in progress">Pickup in progress</option>
            <option value="In Warehouse">In Warehouse</option>
            <option value="In Transit">In Transit</option>
            <option value="Arrived">Arrived</option>
          </select>
        </div> <!-- form-group -->



        <div class="form-group">
          {{html()->label('Warehouse')->for('warehouse')}}
          <select class="form group dropdown-item border" name="warehouse">
            <option value="{{ $status->warehouse }}">{{ $status->warehouse }}</option>
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