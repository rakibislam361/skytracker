<?php

namespace App\Http\Controllers\frontend;

use App\Models\Content\Booking;
use App\Models\Content\Carton;
use App\Http\Controllers\Controller;
use Auth;
use PDF;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.booking.index');
    }

    /**
     * Show the form for creating a new resource.`
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booking = Booking::all();
        return view('backend.booking.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $totalWeight = 0;
        if (Auth::check()) {
            $validateData = $this->bookingDataValidate();

            if (request()->othersProductName) {
                $validateData['othersProductName'] = implode(',', request()->othersProductName);
            }
            if (request()->customer_name == null) {
                $validateData['customer_name'] = auth()->user()->name;
            }

            $cartonvalidateData = $this->cartonDataValidate();

            if (request()->carton_number) {
                $cartonvalidateData['carton_number'] = implode(',', request()->carton_number);
            }
            if (request()->shipping_mark) {
                $cartonvalidateData['shipping_mark'] = implode(',', request()->shipping_mark);
            }
            if (request()->shipping_number) {
                $cartonvalidateData['shipping_number'] = implode(',', request()->shipping_number);
            }
            if (request()->tracking_id) {
                $cartonvalidateData['tracking_id'] = implode(',', request()->tracking_id);
            }
            if (request()->actual_weight) {
                foreach (request()->actual_weight as $key => $value) {
                    $totalWeight += $value;
                }
                $cartonvalidateData['total_weight'] = $totalWeight;
                $cartonvalidateData['actual_weight'] = implode(',', request()->actual_weight);
            }

            $validateData['user_id'] = auth()->user()->id ?? null;
            $store = Booking::create($validateData);
            $storecarton = Carton::create($cartonvalidateData);
            $store->cartons()->attach($storecarton->id);

            if ($store && $storecarton) {
                return redirect()
                    ->back()
                    ->withFlashSuccess('Your Booking Order Placed Successfully');
            }
        } else {
            return view('frontend.auth.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with('cartons')->find($id);
        return view('backend.booking.invoice', compact('booking'));

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
        $booking = Booking::with('cartons')->find($id);

        return view('backend.booking.edit', compact('booking'));
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
        $totalWeight = 0;
        $updateBooking = Booking::findOrFail($id);
        $updateCarton = Carton::findOrFail($id);
        $updateBooking->cartons()->detach($updateCarton->id);

        if ($updateBooking && $updateCarton) {
            $updateBooking->date = $request->date;
            $updateBooking->ctnQuantity = $request->ctnQuantity;
            $updateBooking->totalCbm = $request->totalCbm;
            $updateBooking->productQuantity = $request->productQuantity;
            $updateBooking->productsTotalCost = $request->productsTotalCost;
            $updateBooking->othersProductName = implode(',', $request->othersProductName);
            $updateBooking->bookingProduct = $request->bookingProduct;
            $updateBooking->unit_price = $request->unit_price;
            $updateBooking->amount = $request->amount;
            $updateBooking->paid = $request->paid;
            $updateBooking->remarks = $request->remarks;
            $updateBooking->status = $request->status;

            if (request()->customer_name == null) {
                $updateBooking->customer_name = auth()->user()->name;
            } else {
                $updateBooking->customer_name = $request->customer_name;
            }

            $updateBooking->customer_phone = $request->customer_phone;
            $updateBooking->customer_address = $request->customer_address;

            if (request()->actual_weight) {
                foreach (request()->actual_weight as $key => $value) {
                    $totalWeight += $value;
                }
            }

            $updateCarton->shipping_mark = implode(',', $request->shipping_mark);
            $updateCarton->carton_number = implode(',', $request->carton_number);
            $updateCarton->shipping_number = implode(',', $request->shipping_number);
            $updateCarton->actual_weight = implode(',', $request->actual_weight);
            $updateCarton->total_weight = $totalWeight;
            $updateCarton->warehouse_quantity = $request->warehouse_quantity;
            $updateCarton->shipping_method = $request->shipping_method;
            $updateCarton->chinalocal = $request->chinalocal;
            $updateCarton->packing_cost = $request->packing_cost;
            $updateCarton->tracking_id = implode(',', $request->tracking_id);

            $updateBooking->save();
            $updateCarton->save();
            $updateBooking->cartons()->attach($updateCarton->id);
        }
        return redirect()
            ->route('admin.booking.index')
            ->withFlashSuccess('Booking Order Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        $carton = Carton::find($id);
        if ($booking && $carton) {
            $booking->delete($booking);
            $carton->delete($carton);
        }
        return redirect()
            ->back()
            ->withFlashSuccess('Booking Deleted Successfully');
    }

    public function bookingDataValidate()
    {
        return request()->validate([
            'date' => 'nullable|date',
            'ctnQuantity' => 'nullable|numeric',
            'totalCbm' => 'nullable|numeric',
            'productQuantity' => 'nullable|numeric',
            'productsTotalCost' => 'nullable|between:0,99.99',
            'othersProductName.*' => 'nullable|string',
            'bookingProduct' => 'nullable|string',
            'unit_price' => 'nullable|string',
            'amount' => 'nullable|string',
            'paid' => 'nullable|string',
            'remarks' => 'nullable|string',
            'status' => 'nullable|string',
            'customer_name' => 'nullable|string',
            'customer_phone' => 'nullable|string',
            'customer_address' => 'nullable|string',
        ]);
    }
    public function cartonDataValidate()
    {
        return request()->validate([
            'shipping_mark.*' => 'nullable|string',
            'carton_number.*' => 'nullable|string',
            'shipping_number.*' => 'nullable|string',
            'actual_weight.*' => 'nullable|string',
            'tracking_id.*' => 'nullable|string',
            'warehouse_quantity' => 'nullable|string',
            'shipping_method' => 'nullable|string',
            'chinalocal' => 'nullable|numeric',
            'packing_cost' => 'nullable|numeric',
            'total_weight' => 'nullable|numeric',
        ]);
    }
}
