@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Products Status'))

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">

    {{ html()->modelForm($product, 'PATCH', route('admin.product.product.update',
    $product))->attribute('enctype', 'multipart/form-data')->open() }}

    <x-backend.card>
      <x-slot name="header">
        @lang('Update Products Status')
      </x-slot>

      <x-slot name="headerActions">
        <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.product.index')" :text="__('Cancel')" />
      </x-slot>

      <x-slot name="body">


       <div class="form-group">
          {{html()->label('Name')->for('name')}}
          {{html()->text('name')
          ->class('form-control')
          ->placeholder('Name')
          ->required()}}
        </div>

         <div class="form-group">
          {{html()->label('Invoice')->for('invoice')}}
          {{html()->text('invoice')
          ->class('form-control')
          ->placeholder('Invoice')}}      
        </div>

        <div class="form-group">
          {{html()->label('Shipping Type')->for('shipping_type')}}
          {{html()->text('shipping_type')
          ->class('form-control')
          ->placeholder('Shipping Type')
          ->required()}}
        </div>       

        <div class="form-group">
          {{html()->label('Status')->for('status')}}
          <select class="form group dropdown-item border" name="status">
              <option selected>Select Status</option>
              <option value="Order Placed">Order Placed</option>
              <option value="Pickup in progress">Pickup in progress</option>
              <option value="In Warehouse">In Warehouse</option>
              <option value="In Transit">In Transit</option>
              <option value="Arrived">Arrived</option>
          </select>
        </div> <!-- form-group -->
        

        <div class="form-group">
          {{html()->label('warehouse')->for('warehouse')}}
          {{html()->text('warehouse')
          ->class('form-control')
          ->placeholder('Warehouse')}}
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