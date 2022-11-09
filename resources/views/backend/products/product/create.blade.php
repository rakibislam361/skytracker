@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create Product'))

@section('content')



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="row justify-content-center">
  <div class="col-md-10">


    <form action="{{ route('admin.product.product.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <x-backend.card>
        <x-slot name="header">
          @lang('Create product')
        </x-slot>

        <x-slot name="headerActions">
          <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.product.index')" :text="__('Cancel')" />
        </x-slot>

        <x-slot name="body">

          <div class="form-group">
            <label for="invoice">Invoice</label>
            <input type="text" name="invoice" placeholder="Invoice ID" class="form-control" />
          </div>

          <div class="form-group">
            <label for="productName">Name</label>
            <table style="width:100%" id="dynamicAddRemove">
              <tr>
                <td><input type="text" name="productName[]" placeholder="Enter product name" class="form-control" /></td>
                <td class="text-right" style="width:10%"><button type="button" name="add" id="add-btn" class="btn btn-success">Add</button></td>
                <td class="text-right" style="width:10%"><button type="button" class="btn btn-danger">Remove</button></td>
              </tr>
            </table>
          </div>

          <div class="form-group">
            <label for="shipping_type">Shipping Type</label>
            <select class="form group dropdown-item border" name="shipping_type">
              <option selected value="0"></option>
              <option value="By Air">By Air</option>
              <option value="By Road">By Road</option>
              <option value="By Ship">By Ship</option>

            </select>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select class="form group dropdown-item border" name="status">
              <option value=""></option>
              @foreach ($status as $stat)
              <option value="{{$stat->id}}">{{$stat->name}}</option>
              @endforeach

            </select>
          </div> <!-- form-group -->

          <div class="form-group">
            <label for="warehouse">Warehouse</label>
            <select class="form group dropdown-item border" name="warehouse">
              <option value=""></option>
              @foreach ($warehouse as $ware)
              <option value="{{$ware->id}}">{{$ware->name}}</option>
              @endforeach

            </select>
          </div> <!-- form-group -->


        </x-slot>

        <x-slot name="footer">
          <button class="btn btn-sm btn-primary" type="submit">@lang('Create product')</button>
        </x-slot>
      </x-backend.card>
    </form>


  </div>

</div>


{{-- <script type="text/javascript">
// var i = 0;
// $("#add-btn").click(function(){
// ++i;
// $("#dynamicAddRemove").append('<tr><td><input type="text" name="productName[]" placeholder="Enter product name" class="form-control" /></td><td class="text-right" style="width:10%"><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
// });
// $(document).on('click', '.remove-tr', function(){  
// $(this).parents('tr').remove();
// });  

</script> --}}





@endsection