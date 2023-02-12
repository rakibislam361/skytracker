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
    public function details($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('backend.booking.invoice', compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_name = null;
        $carton = null;
        $weight = null;
        $unit = null;
        $amount = null;
        $customer_name = [];
        $customer_phone = [];
        $customer_address = [];
        $productsTotalCost = [];
        $productQuantity = [];
        $totalCbm = [];
        $ctnQuantity = [];
        $shipping_mark = [];
        $shipping_number = [];
        $tracking_id = [];
        $remarks = [];
        $status = [];

        $createInvoice = new Invoice();
        foreach ($request->booking_id as $key => $value) {
            $id = $value;
            $booking = Booking::findOrFail($id);
            $customer_name[] = $booking->customer_name;
            $customer_phone[] = $booking->customer_phone;
            $customer_address[] = $booking->customer_address;
            $productsTotalCost[] = $booking->productsTotalCost;
            $productQuantity[] = $booking->productQuantity;
            $totalCbm[] = $booking->totalCbm;
            // $user_id[] = $booking->user_id;
            $ctnQuantity[] = $booking->ctnQuantity;
            $shipping_mark[] = $booking->shipping_mark;
            $shipping_number[] = $booking->shipping_number;
            $tracking_id[] = $booking->tracking_number;
            $remarks[] = $booking->remarks;
            $status[] = $booking->status;
        }
        if ($request->othersProductName) {
            $product_name = implode(',', $request->othersProductName);
        }
        if ($request->carton_number) {
            $carton = implode(',', $request->carton_number);
        }
        if ($request->actual_weight) {
            $weight = implode(',', $request->actual_weight);
        }
        if ($request->unit_price) {
            $unit = implode(',', $request->unit_price);
        }
        if ($request->amount) {
            $amount = implode(',', $request->amount);
        }
        $customer_name = implode(',', $customer_name);
        $customer_phone = implode(',', $customer_phone);
        $customer_address = implode(',', $customer_address);
        $productsTotalCost = implode(',', $productsTotalCost);
        $productQuantity = implode(',', $productQuantity);
        $totalCbm = implode(',', $totalCbm);
        // $user_id = implode(',', $user_id);
        $ctnQuantity = implode(',', $ctnQuantity);
        $shipping_mark = implode(',', $shipping_mark);
        $shipping_number = implode(',', $shipping_number);
        $tracking_id = implode(',', $tracking_id);
        $remarks = implode(',', $remarks);
        $status = implode(',', $status);


        $createInvoice = new Invoice();

        $createInvoice->customer_name = $customer_name;
        $createInvoice->customer_phone = $customer_phone;
        $createInvoice->customer_address = $customer_address;
        $createInvoice->total_payable = $request->total_payable;
        $createInvoice->total_courier = $request->total_courier;
        $createInvoice->total_due = $request->total_due;
        $createInvoice->payment_method = $request->payment_method;

        $createInvoice->packing_cost = $request->packing_cost;
        $createInvoice->chinalocal = $request->chinalocal;
        $createInvoice->delivery_method = $request->delivery_method;

        $createInvoice->product_name = $product_name;

        $createInvoice->product_cost = $productsTotalCost;
        $createInvoice->user_id = auth()->user()->id ?? null;
        $createInvoice->product_qty = $productQuantity;
        $createInvoice->cbm = $booking->totalCbm;
        $createInvoice->carton_qty = $ctnQuantity;
        // $createInvoice->warehouse_qty = $booking->warehouse_quantity;
        $createInvoice->carton_number = $carton;
        $createInvoice->shipping_mark = $shipping_mark;
        $createInvoice->shipping_number = $shipping_number;
        $createInvoice->tracking_number = $tracking_id;
        $createInvoice->actual_weight = $weight;
        // $createInvoice->total_weight = $booking->total_weight;
        $createInvoice->unit_price = $unit;
        $createInvoice->remarks = $remarks;
        $createInvoice->amount = $amount;
        $createInvoice->paid = $request->paid;
        $createInvoice->status = $status;
        $createInvoice->save();
        $createInvoice->update([
            'invoice_id' => 'INV' . generate_order_number($createInvoice->id, 4),
        ]);
        return redirect()
            ->route('admin.invoice.index')
            ->withFlashSuccess('Invoice Generated Successfully');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            $invoice->delete($invoice);
        }
        return redirect()
            ->back()
            ->withFlashSuccess('Invoice Deleted Successfully');
    }
}
