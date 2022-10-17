@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create Role'))

@section('content')

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"> --}}

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="row justify-content-center">
  <div class="col-md-6">


    {{ html()->form('POST', route('admin.product.product.store'))->attribute('enctype', 'multipart/form-data')->open() }}
    <x-backend.card>
      <x-slot name="header">
        @lang('Create product')
      </x-slot>

      <x-slot name="headerActions">
        <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.product.index')" :text="__('Cancel')" />
      </x-slot>

      <x-slot name="body">

        <div class="form-group">
          {{html()->label('Invoice')->for('invoice')}}
          {{html()->text('invoice')
          ->class('form-control')
          ->placeholder('Invoice')}}          
        </div>



        <div class="form-group">
          {{html()->label('Name')->for('name')}}
        <table class="table table-bordered" id="dynamicAddRemove">  
          <tr>  
            <td><input type="text" name="name" placeholder="Enter product name" class="form-control" /></td>  
            <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>  
          </tr>  
        </table> 
        </div>

        

        <div class="form-group">
          {{html()->label('Shipping Type')->for('shipping_type')}}
          <select class="form group dropdown-item border" name="shipping_type">
              <option selected value="0"></option>
              <option value="air">By Air</option>
              <option value="road">By Road</option>
              <option value="ship">By Ship</option>
              
          </select>
        </div>

        <div class="form-group">
          {{html()->label('Status')->for('status')}}
          <select class="form group dropdown-item border" name="status">
               <option selected value="0"></option>
              <option value="Order Placed">Order Placed</option>
              <option value="Pickup in progress">Pickup in progress</option>
              <option value="In Warehouse">In Warehouse</option>
              <option value="In Transit">In Transit</option>
              <option value="Arrived">Arrived</option>
          </select>
        </div> <!-- form-group -->
        

        <div class="form-group">
          {{html()->label('warehouse')->for('warehouse')}}
            <select class="form group dropdown-item border" name="warehouse">
              <option selected value="0"></option>
              <option value="Dhaka">DHAKA</option>
              <option value="China">CHINA</option>
              <option value="Chittagong">CHITTAGONG</option>
             
          </select>
        </div> <!-- form-group -->


      </x-slot>

      <x-slot name="footer">
        <button class="btn btn-sm btn-primary" type="submit">@lang('Create product')</button>
      </x-slot>
    </x-backend.card>

    {{ html()->form()->close() }}

  </div>

</div>


  <script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><input type="text" name="name" placeholder="Enter product name" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  


</script>





@endsection