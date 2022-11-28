<div class="table-responsive">
  <table class="table table-hover table-bordered mb-0 order-table">
    <thead>
      <tr>
        <th class="align-content-center text-center">Date</th>
         <th class="align-content-center text-center">Item Number</th>
        <th class="align-content-center text-center">Order ID</th>
        <th class="align-content-center text-center">Customer</th>
        <th class="align-content-center text-center">Phone </th>       
        <th class="align-content-center text-center">Product Name</th>
        <th class="align-content-center text-center">Transaction ID</th>     
        <th class="align-content-center text-center">Quantity</th>
        <th class="align-content-center text-center">Shipped By</th>
        <th class="align-content-center text-center">Order(rmb)</th>
        <th class="align-content-center text-center">China Local Delivery</th>
        <th class="align-content-center text-center">Product Cost</th>
        <th class="align-content-center text-center">Product Purchase Cost</th>
        <th class="align-content-center text-center">Tracking Number</th>
        <th class="align-content-center text-center">Rate</th>
        <th class="align-content-center text-center">Weight</th>
        <th class="align-content-center text-center">Amount</th>
        <th class="align-content-center text-center">Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>


@foreach ($data as $order)

    
      <tr onclick="orderModal({{json_encode($order)}})">
        <td class="align-content-center text-center">{{ $order->created_at->format('d/m/Y') }}</td>  
        <td class="align-content-center text-center">00008108</td>
        <td class="align-content-center text-center">{{ $order->order_number }}</td>
        <td class="align-content-center text-center">{{ $order->name }}</td>
        <td class="align-content-center text-center"> {{ $order->phone }} </td>
        <td class="align-content-center text-center">new style sunglasses European and American fashion</td>
        <td class="align-content-center text-center">{{ $order->transaction_id }}</td>        
        <td class="align-content-center text-center">9</td>
        <td class="align-content-center text-center">ship_by_air</td>
        <td class="align-content-center text-center">20</td>
        <td class="align-content-center text-center">60</td>
        <td class="align-content-center text-center">460</td>
        <td class="align-content-center text-center">18</td>
        <td class="align-content-center text-center">300</td>      
        <td class="align-content-center text-center">22</td>
        <td class="align-content-center text-center">1kg</td>
        <td class="align-content-center text-center">{{ $order->amount }}</td>
        <td class="align-content-center text-center">{{ $order->status }}</td>
        <td class="align-content-center text-center"><a>Edit</a></td>
      </tr>
      @endforeach     
    </tbody>
  </table>
  {{ $data->links() }}
</div> 


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    function orderModal(data) {
        // console.log(data);
      $("#changeStatusButton").modal('show');
            $('#ItemNo').val(data.order_number);
    }
</script>
 

