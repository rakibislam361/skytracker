<?php

namespace App\Http\Controllers\frontend;

use App\Models\Content\booking;
use App\Http\Controllers\Controller;
use Auth;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booking = booking::all();
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
        if (Auth::check()) {
            $validateData = $this->bookingDataValidate();
            $validateData['user_id'] = auth()->user()->id ?? null;
            $store = booking::create($validateData);
            if ($store) {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = booking::find($id);

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
        $updateBooking = booking::findOrFail($id);

        if ($updateBooking) {
            $updateBooking->date = $request->date;
            $updateBooking->ctnQuantity = $request->ctnQuantity;
            $updateBooking->totalCbm = $request->totalCbm;
            $updateBooking->productQuantity = $request->productQuantity;
            $updateBooking->productsTotalCost = $request->productsTotalCost;
            $updateBooking->othersProductName = $request->othersProductName;
            $updateBooking->bookingProduct = $request->bookingProduct;
            $updateBooking->shipping_mark = $request->shipping_mark;
            $updateBooking->carton_number = $request->carton_number;
            $updateBooking->shipping_number = $request->shipping_number;
            $updateBooking->actual_weight = $request->actual_weight;
            $updateBooking->unit_price = $request->unit_price;
            $updateBooking->amount = $request->amount;
            $updateBooking->tracking_id = $request->tracking_id;
            $updateBooking->remarks = $request->remarks;
            $updateBooking->status = $request->status;
            $updateBooking->save();
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
        $booking = booking::find($id);
        if ($booking) {
            $booking->delete($booking);
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
            'othersProductName' => 'nullable|string',
            'bookingProduct' => 'nullable|string',
            'shipping_mark' => 'nullable|string',
            'carton_number' => 'nullable|string',
            'shipping_number' => 'nullable|string',
            'actual_weight' => 'nullable|string',
            'unit_price' => 'nullable|string',
            'amount' => 'nullable|string',
            'tracking_id' => 'nullable|string',
            'remarks' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
    }
}
