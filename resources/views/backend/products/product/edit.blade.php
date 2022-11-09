@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Products Status'))

@section('content')


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="row justify-content-center">
  <div class="col-md-10">

    {{ html()->modelForm($product, 'PATCH', route('admin.product.product.update', $product))->attribute('enctype', 'multipart/form-data')->open() }}
    @csrf


    <x-backend.card>
      <x-slot name="header">
        @lang('Update Products Status')
      </x-slot>

      <x-slot name="headerActions">
        <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.product.index')" :text="__('Cancel')" />
      </x-slot>

      <x-slot name="body">


        <div class="form-group">
          <label for="invoice">Invoice</label>
          <input type="text" value="{{ $product->invoice }}" name="invoice" placeholder="Invoice ID" class="form-control" />
        </div>



        <div class="form-group">
          <label for="productName">Name</label>
          <table style="width:100%" id="dynamicAddRemove">

            <?php $p_name = json_decode($product->productName, true); ?>
            @foreach($p_name as $pName)
            <tr>
              <td><input type="text" name="productName[]" value={{$pName}} class="form-control" /></td>
              <td class="text-right" style="width:10%"><button type="button" name="add" id="add-btn" class="btn btn-success">Add</button></td>
              <td class="text-right" style="width:10%"><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
            </tr>
            @endforeach
          </table>
        </div>



        <div class="form-group">
          <label for="shipping_type">Shipping Type</label>
          <select class="form group dropdown-item border" name="shipping_type">
            <option selected value="{{ $product->shipping_type }}">{{ $product->shipping_type }}</option>
            <option value="By Air">By Air</option>
            <option value="By Road">By Road</option>
            <option value="By Ship">By Ship</option>

          </select>
        </div>

       <div class="form-group">
            <label for="status">Status</label>
            <select class="form group dropdown-item border" name="status"> 
              @foreach ($status as $stat)             
              <option value="{{$stat->id}}" {{ $product->status_id == $stat->id ? 'selected' : '' }} >{{$stat->name}}</option>
              @endforeach
            </select>
          </div> <!-- form-group -->


       <div class="form-group">
            <label for="warehouse">Warehouse</label>
            <select class="form group dropdown-item border" name="warehouse"> 
              @foreach ($warehouse as $ware)             
              <option value="{{$ware->id}}" {{ $product->warehouse_id == $ware->id ? 'selected' : '' }} >{{$ware->name}}</option>
              @endforeach
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