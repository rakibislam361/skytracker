<div class="modal fade" id="statusChangeFormModal" tabindex="-1" aria-labelledby="statusChangeFormModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusChangeFormModalLabel">Edit order status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="editOrderStatus">
          @csrf
          <div class="form-group">
            <select name="status" class="form-control" id="status">
              <option value="">- Select Status -</option>
              <option value="on-hold">On Hold</option>
              <option value="processing">Processing</option>
              <option value="purchased">Purchased Complete</option>
              <option value="shipped-from-suppliers">shipped-from-suppliers</option>
              <option value="received-in-china-warehouse">received-in-china-warehouse</option>
              <option value="shipped-from-china-warehouse">shipped-from-china-warehouse</option>
              <option value="received-in-BD-warehouse">received-in-BD-warehouse</option>
              <option value="on-transit-to-customer">on-transit-to-customer</option>
              <option value="delivered">delivered</option>
              <option value="out-of-stock">out-of-stock</option>
              <option value="adjustment">adjustment</option>
              <option value="refunded">refunded</option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
