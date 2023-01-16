<div class="col-md-8">
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders Item</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Name</th>
                            <th>Product Value</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $acc)
                            <tr>
                                <td>{{ $acc->order_item_number ? $acc->order_item_number : 'N/A' }}</td>
                                <td>{{ $acc->user->name ? $acc->user->name : 'N/A' }}</td>
                                <td>{{ $acc->product_value ? $acc->product_value : 'N/A' }}</td>
                                <td><span class="badge badge-success">{{ $acc->status ? $acc->status : 'N/A' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $accounts->withQueryString()->links() }}
            </div>
        </div>
        <div class="card-footer clearfix">
            <a href={{ route('admin.order.index') }} class="btn btn-sm btn-secondary float-right">View All Orders</a>
        </div>
    </div>
</div>
