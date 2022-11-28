<div class="card">
  <div class="card-header" style="border-bottom: ;">
   <h5 class="d-inline-block mr-2">@lang('Filters')</h5>
  </div>
  <div class="card-body">
  <form>
    <div class="row">
     <div class="col">
      <label for="itemNO">Item</label>
      <input type="text" id="itemNO" name="itemNO" class="form-control" placeholder="item number">
     </div>
     <div class="col">
      <label for="status">Status</label>
      <select class="form-control" id="status" name="status">
          <option value="">Select</option>
           <option value="purchased">Purchased</option>
           <option value="noStock">Out of stock</option>
           <option value="delivered">Delivered</option>
           <option value="refund">Refund</option>
           <option value="received">Received</option>
           <option value="receivechina">Received in china warehouse</option>
           <option value="shipchina">Shipped from china Warehouse</option>
           <option value="receiveBD">Received in BD warehouse</option>
      </select>
     </div>

     <div class="col">
      <label for="date">From date</label>
       <input type="date" id="startdate" class="form-control" name="startdate">
     </div>

     <div class="col">
       <label for="date">To Date</label>
        <input type="date" id="enddate" name="enddate" class="form-control">
     </div>

     <div class="col">
       <label for="keyword">Keywords</label>
         <input type="text" name="keyword" id="keyword" placeholder="Keywords" class="form-control" />
     </div>
    </div>
    <div class="text-right" style="padding-top: 15px;">
       <button type="submit" class="btn btn-primary" id="filter" name="filter"><i class="fa fa-search"></i> Search</button>
     </div>
  </form>
  </div>
</div>