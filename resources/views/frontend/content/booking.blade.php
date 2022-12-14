 <div class="card" style="border:0px;">
     <div class="card-header" style="border:0px;">
         <div style="display: flex; justify-content: center; font-size: 150%; font-weight: bold;">
             Book Your Shipping Order</div>
     </div>

     <form action="{{ route('frontend.content.booking') }}" method="post" id="booking" name="booking">
         @csrf
         <div class="form-row mb-1">Select Date:</div>
         <div class="form-row mb-2">
             <div class="col"><input type="date" name="date" class="form-control" placeholder="approx date"
                     value="" style="border-radius: 10rem; width: 60%;">
             </div>
         </div>
         <div class="form-row mb-1">Carton quantity:</div>
         <div class="form-row mb-2">
             <div class="col"><input type="number" name="ctnQuantity" class="form-control" placeholder="quantity"
                     value="" style="border-radius: 10rem; width: 60%;">
             </div>
         </div>
         <div class="form-row mb-1">Total CBM:</div>
         <div class="form-row mb-2">
             <div class="col"><input type="number" name="totalCbm" class="form-control" placeholder="total CBM"
                     value="" style="border-radius: 10rem; width: 60%;">
             </div>
         </div>
         <div class="form-row mb-1">Product Quantity:</div>
         <div class="form-row mb-2">
             <div class="col"><input type="number" name="productQuantity" class="form-control"
                     placeholder="product quantity" value="" style="border-radius: 10rem; width: 60%;">
             </div>
         </div>
         <div class="form-row mb-1">Products Total Cost:</div>
         <div class="form-row mb-2">
             <div class="col"><input type="number" name="productsTotalCost" class="form-control"
                     placeholder="total Cost(BDT)" value="" style="border-radius: 10rem; width: 60%;">
             </div>
         </div>
         <div class="form-row mb-1">Product Name (specific):
         </div>
         <div class="form-row mb-2">
             <div class="col"><input type="text" name="othersProductName" class="form-control"
                     placeholder="product name" value="" style="border-radius: 10rem; width: 60%;">
             </div>
         </div>
         <div class="form-row mb-1">Products Image:</div>
         <div class="form-row mb-4">
             <div class="box-input-file" style="display: flex; justify-content: center;">
                 <input id="upload-image-input" name="bookingProduct" class="upload" type="file">
             </div>
         </div>
         <button class="btn f-right nextBtn-2 btn-success" type="submit">Book Now</button>

     </form>

 </div>
