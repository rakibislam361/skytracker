<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Booking;
use App\Models\Content\Invoice;
use App\Models\Content\Carton;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.invoice.index');
    }

    /**
     * Show the form for creating a new resource.`
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $booking = booking::all();
        // return view('backend.invoice.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->booking_id;
        $booking = booking::findOrFail($id);
        // dd($booking->cartons[0]->shipping_mark);
        $createInvoice = new Invoice();
        $createInvoice->invoice_id = 'INV' . generate_order_number($id, 4);
        $createInvoice->customer_name = $booking->user->name;
        $createInvoice->customer_phone = $booking->user->phone;
        $createInvoice->customer_address = $booking->user->address;
        $createInvoice->user_id = $booking->user->id;
        $createInvoice->total_payable = $request->total_payable;
        $createInvoice->total_courier = $request->total_courier;
        $createInvoice->total_due = $request->total_due;
        $createInvoice->payment_method = $request->payment_method;
        $createInvoice->delivery_method = $request->delivery_method;
        $createInvoice->product_name = $booking->othersProductName;
        $createInvoice->product_cost = $booking->productsTotalCost;
        $createInvoice->product_qty = $booking->productQuantity;
        $createInvoice->cbm = $booking->totalCbm;
        $createInvoice->carton_qty = $booking->ctnQuantity;
        $createInvoice->warehouse_qty = $booking->cartons[0]->warehouse_quantity;
        $createInvoice->carton_number = $booking->cartons[0]->carton_number;
        $createInvoice->shipping_mark = $booking->cartons[0]->shipping_mark;
        $createInvoice->shipping_number = $booking->cartons[0]->shipping_number;
        $createInvoice->tracking_number = $booking->cartons[0]->tracking_id;
        $createInvoice->actual_weight = $booking->cartons[0]->actual_weight;
        $createInvoice->unit_price = $booking->unit_price;
        $createInvoice->remarks = $booking->remarks;
        $createInvoice->amount = $booking->amount;
        $createInvoice->status = $booking->status;
        $createInvoice->save();
        return redirect()
            ->back()
            ->withFlashSuccess('Invoice Generated Successfully');

        // dd($booking->othersProductName);
        // if (Auth::check()) {
        //     $validateData = $this->bookingDataValidate();

        //     if (request()->othersProductName) {
        //         $validateData['othersProductName'] = implode(',', request()->othersProductName);
        //     }

        //     $cartonvalidateData = $this->cartonDataValidate();

        //     if (request()->carton_number) {
        //         $cartonvalidateData['carton_number'] = implode(',', request()->carton_number);
        //     }
        //     if (request()->shipping_mark) {
        //         $cartonvalidateData['shipping_mark'] = implode(',', request()->shipping_mark);
        //     }
        //     if (request()->shipping_number) {
        //         $cartonvalidateData['shipping_number'] = implode(',', request()->shipping_number);
        //     }
        //     if (request()->tracking_id) {
        //         $cartonvalidateData['tracking_id'] = implode(',', request()->tracking_id);
        //     }

        //     $validateData['user_id'] = auth()->user()->id ?? null;
        //     $store = Booking::create($validateData);
        //     $storecarton = Carton::create($cartonvalidateData);
        //     $store->cartons()->attach($storecarton->id);

        //     if ($store && $storecarton) {
        //         return redirect()
        //             ->back()
        //             ->withFlashSuccess('Your Booking Order Placed Successfully');
        //     }
        // } else {
        //     return view('frontend.auth.login');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $booking = booking::with('cartons')->find($id);
        // return view('backend.booking.invoice', compact('booking'));

        // return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $booking = booking::with('cartons')->find($id);

        // return view('backend.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $updateBooking = booking::findOrFail($id);
        // $updateCarton = carton::findOrFail($id);
        // $updateBooking->cartons()->detach($updateCarton->id);

        // if ($updateBooking && $updateCarton) {

        //     $updateBooking->date = $request->date;
        //     $updateBooking->ctnQuantity = $request->ctnQuantity;
        //     $updateBooking->totalCbm = $request->totalCbm;
        //     $updateBooking->productQuantity = $request->productQuantity;
        //     $updateBooking->productsTotalCost = $request->productsTotalCost;
        //     $updateBooking->othersProductName = implode(',', $request->othersProductName);
        //     $updateBooking->bookingProduct = $request->bookingProduct;
        //     $updateBooking->unit_price = $request->unit_price;
        //     $updateBooking->amount = $request->amount;
        //     $updateBooking->remarks = $request->remarks;
        //     $updateBooking->status = $request->status;


        //     $updateCarton->shipping_mark = implode(',', $request->shipping_mark);
        //     $updateCarton->carton_number = implode(',', $request->carton_number);
        //     $updateCarton->shipping_number = implode(',', $request->shipping_number);
        //     $updateCarton->actual_weight = $request->actual_weight;
        //     $updateCarton->warehouse_quantity = $request->warehouse_quantity;
        //     $updateCarton->tracking_id = implode(',', $request->tracking_id);

        //     $updateBooking->save();
        //     $updateCarton->save();
        //     $updateBooking->cartons()->attach($updateCarton->id);
        // }
        // return redirect()
        //     ->route('admin.booking.index')
        //     ->withFlashSuccess('Booking Order Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $booking = booking::find($id);
        // $carton = carton::find($id);
        // if ($booking && $carton) {
        //     $booking->delete($booking);
        //     $carton->delete($carton);
        // }
        // return redirect()
        //     ->back()
        //     ->withFlashSuccess('Booking Deleted Successfully');
    }
}
