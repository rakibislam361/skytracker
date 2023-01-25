<?php

namespace App\Http\Controllers\frontend;

use App\Models\Content\Booking;
use App\Models\Content\Carton;
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
     * Show the form for creating a new resource.`
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

            if (request()->othersProductName) {
                $validateData['othersProductName'] = implode(',', request()->othersProductName);
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
        $booking = booking::with('cartons')->find($id);

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
        $updateCarton = carton::findOrFail($id);
        $updateBooking->cartons()->detach($updateCarton->id);

        if ($updateBooking) {

            $updateBooking->date = $request->date;
            $updateBooking->ctnQuantity = $request->ctnQuantity;
            $updateBooking->totalCbm = $request->totalCbm;
            $updateBooking->productQuantity = $request->productQuantity;
            $updateBooking->productsTotalCost = $request->productsTotalCost;
            $updateBooking->othersProductName = implode(',', $request->othersProductName);
            $updateBooking->bookingProduct = $request->bookingProduct;
            $updateBooking->unit_price = $request->unit_price;
            $updateBooking->amount = $request->amount;
            $updateBooking->remarks = $request->remarks;
            $updateBooking->status = $request->status;

            $updateCarton->shipping_mark = implode(',', $request->shipping_mark);
            $updateCarton->carton_number = implode(',', $request->carton_number);
            $updateCarton->shipping_number = implode(',', $request->shipping_number);
            $updateCarton->actual_weight = $request->actual_weight;
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
        $booking = booking::find($id);
        $carton = carton::find($id);
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
            'remarks' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
    }
    public function cartonDataValidate()
    {
        return request()->validate([

            'shipping_mark.*' => 'nullable|string',
            'carton_number.*' => 'nullable|string',
            'shipping_number.*' => 'nullable|string',
            'actual_weight' => 'nullable|string',
            'tracking_id.*' => 'nullable|string',
            'warehouse_quantity' => 'nullable|string',

        ]);
    }
}
