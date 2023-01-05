   @include('frontend.style.style')
   @include('frontend.content.header')
   @include('includes.partials.messages')
   <div class="container" style="padding-top:20px;padding-bottom:20px;">
       {{-- <div class="row ownmodal"> --}}
       <div class="row">
           <div class="col-5" style="background-color: #4e148c;">
               <div class="card" style="background-color: #4e148c; border:0px;">
                   <div class="card-header" style="border:0px;">
                       <div
                           style="display: flex; justify-content: center; font-size: 150%; color: white; font-weight: bold;">
                           Approximate shipping cost</div>
                   </div>
                   <div class="card-body">
                       <div class="row" style="display: flex; flex-direction: row; justify-content: space-around;">
                           <div class="col-12 justify-content-between">
                               <table class="booking-table">
                                   <tr>
                                       <td>Ship By</td>
                                       <td>air</td>
                                   </tr>
                                   <tr>
                                       <td>Ship From</td>
                                       <td>{{ $shipped_from ?? '' }}</td>
                                   </tr>

                                   <tr>
                                       <td>Product Type</td>
                                       <td>{{ $category ?? '' }}</td>
                                   </tr>

                                   <tr>
                                       <td>Per kg</td>
                                       <td>{{ $rate ?? '' }}/kg</td>
                                   </tr>

                                   <tr>
                                       <td>Total weight</td>
                                       <td>{{ $weight ?? '' }} kg/</td>
                                   </tr>

                                   <tr>
                                       <td>Per kg</td>
                                       <td>{{ $rate ?? '' }}/kg</td>
                                   </tr>

                                   <tfoot style="border-top: 1px solid white">
                                       <tr>
                                           <td style="font-size:24px">Total</td>
                                           <td style="font-size:24px">{{ $cal_rate ?? '' }}</td>
                                       </tr>
                                   </tfoot>
                               </table>
                           </div>
                       </div>
                       <div class="row" style="display: flex; flex-direction: row; justify-content: space-around;">
                           <div style="font-size: 150%; color: white; font-weight: bold;">

                           </div>
                           <div style="font-size: 150%; color: white; font-weight: bold;">
                           </div>
                       </div>

                       <div style="color: white; font-size: 100%; display: flex; justify-content: center;">
                           (IF 1 CBM= 167kg)</div>

                       <div class="row"
                           style="color: orange; font-family: sans-serif; display: flex; justify-content: center; padding: 30px 15px 0px 20px;">
                           **৫ কেজির নিচের সকল পার্সেল এর দাম সাধারণ দামের চেয়ে
                           তুলনামূলক ভাবে
                           বেশি
                           থাকবে ।</div>

                       <div class="row mt-3">
                           <div class="col">
                               <div class="center-head" style="margin-bottom: 0px;">
                                   <span style="text-transform: none; color: red;">read
                                       carefully</span>
                               </div>
                           </div>
                       </div>
                       <div style="color: white; padding-top: 15px; padding-bottom: 10px;">
                           উপরের
                           রেটটি সম্ভাব্য রেট। কনফার্ম রেট পেতে নিচের তথ্য প্রদান
                           পূর্বক বুকিং
                           করুন
                           । বুকিং এর ২৪ ঘণ্টার মধ্যে আপনার শিপমেন্টের সকল প্রকার খরচ
                           আপনাকে
                           জানিয়ে
                           দেয়া হবে।</div>
                   </div>
               </div>
           </div>
           {{-- leftSideEndHere --}}
           <div class="col-7">
               @include('frontend.content.booking')
           </div>
           {{-- RightSideEndHere --}}
       </div>
   </div>
   @include('frontend.content.footer')
   {{-- </div>
   </div> --}}
   @include('frontend.style.js')
