{{ html()->modelForm($orderItem, 'post', route('admin.order.update', $orderItem->id))->open() }}
@method('PATCH')

<input type="hidden" name="order_update" id="order_update" value="withoutajax" class="form-control" />

<input type="hidden" name="carton_id[]" class="form-control" />

<input type="hidden" name="order_item_id" id="order_item_id" value={{ $orderItem->id }} class="form-control" />

<div class="row">
    <div class="form-group col-md-4">
        {{ html()->label('China Local Shipping')->for('chinaLocalDelivery') }}
        {{ html()->text('chinaLocalDelivery')->class('form-control')->placeholder('China Local Shipping') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('1688 Order Number')->for('order_number') }}
        {{ html()->text('order_number')->class('form-control')->placeholder('1688 Order Number') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('China To BD Tracking Number')->for('tracking_number') }}
        {{ html()->text('tracking_number[]')->class('form-control')->placeholder('China To BD Tracking Number') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('China to BD Shipping Rate')->for('shipping_rate') }}
        {{ html()->text('shipping_rate')->class('form-control')->placeholder('China to BD Shipping Rate') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Actual Weight')->for('actual_weight') }}
        {{ html()->text('actual_weight')->class('form-control')->placeholder('Actual Weight') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('China to BD Shipping Charge')->for('shipping_charge') }}
        {{ html()->text('shipping_charge')->class('form-control')->readOnly(true)->placeholder('China to BD Shipping Charge') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Total Quantity')->for('quantity') }}
        {{ html()->text('quantity')->class('form-control')->readOnly(true)->placeholder('Total Quantity') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Total Product Value')->for('product_value') }}
        {{ html()->text('product_value')->class('form-control')->readOnly(true)->placeholder('Product Value') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('First Payment')->for('first_payment') }}
        {{ html()->text('first_payment')->class('form-control')->readOnly(true)->placeholder('First Payment') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Courier Bill')->for('courier_bill') }}
        {{ html()->text('courier_bill')->class('form-control')->placeholder('Courier Bill') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Out Of Stock')->for('out_of_stock') }}
        {{ html()->text('out_of_stock')->class('form-control')->placeholder('Out Of Stock') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Missing')->for('missing') }}
        {{ html()->text('missing')->class('form-control')->placeholder('Missing') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Adjustment')->for('adjustment') }}
        {{ html()->text('adjustment')->class('form-control')->placeholder('Adjustment') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Refunded')->for('refunded') }}
        {{ html()->text('refunded')->class('form-control')->placeholder('Refunded') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Due Payment')->for('due_payment') }}
        {{ html()->text('due_payment')->class('form-control')->placeholder('Due Payment') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-4">
        {{ html()->label('Last Payment')->for('last_payment') }}
        {{ html()->text('last_payment')->class('form-control')->placeholder('Last Payment') }}
    </div> <!-- form-group -->
    <div class="form-group col-md-12">
        {{ html()->label('Status')->for('status') }}
        {{ html()->select('status', $orderStatus)->class('form-control') }}
    </div> <!-- form-group -->
</div>

<hr>

<table class="table">
    <tr>
        <th>Image</th>
        <th>Attributes</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
    </tr>
    @foreach ($orderItem->item_variations as $variation)
    <tr>
        <td class="text-center p-0">
            <img src="{{ asset($variation->image) }}" width="80" alt="">
        </td>
        <td class="text-center">
            @php
            $attributes = json_decode($variation->attributes);
            @endphp
            @forelse ($attributes as $attribute)
            @php
            $PropertyName = $attribute->PropertyName;
            $Value = $attribute->Value;
            @endphp
            @if ($loop->first)
            <p class="m-0">
                {!! $PropertyName !!}: <span class="ml-2">
                    {!! $Value !!}</span>
            </p>
            @else
            <p class="m-0">{!! $PropertyName !!}: {!! $Value !!}</p>
            @endif
            @empty
            <p class="m-0">No Attributes</p>
            @endforelse
        </td>
        <td>
            {{ html()->text("variation[{$variation->id}][quantity]")->class('form-control')->value($variation->quantity) }}
        </td>
        <td>
            {{ html()->text("variation[{$variation->id}][price]")->class('form-control')->value($variation->price) }}
        </td>
        <td>
            {{ $variation->subTotal }}
        </td>
    </tr>
    @endforeach

</table>

<hr>



<div class="form-group">
    {{ form_submit(__('Update'), 'btn btn-primary btn-block') }}
    {{-- <button type="button" class="btn btn-primary" id="editBtn">Save changes</button> --}}
</div>


{{ html()->closeModelForm() }}