<?php

namespace App\Http\Controllers\frontend;

use App\Models\Content\Booking;
use App\Models\Content\Carton;
use App\Models\Content\ItemTracking;
use App\Http\Controllers\Controller;
use Auth;
use PDF;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;

class bookingController extends Controller
{
    use PaginationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer_name = request('customer_name', null);
        $customer_phone = request('customer_phone', null);
        $status = request('status', null);
        $carton_number = request('carton_number', null);
        $shipping_number = request('shipping_number', null);

        $booking = Booking::with('cartons')->latest();
        if ($customer_name) {
            $booking->where('customer_name', 'like', '%' . $customer_name . '%');
        }
        if ($customer_phone) {
            $booking->where('customer_phone', 'like', '%' .  $customer_phone . '%');
        }
        if ($status) {
            $booking->where('status', $status);
        }
        if ($shipping_number) {
            $booking->where('shipping_number', 'like', '%' .  $shipping_number . '%');
        }

        if ($carton_number) {
            $booking->whereHas('cartons', function ($query) use ($carton_number) {
                $query->where('carton_number', 'like', '%' . $carton_number . '%');
            });
        }
        $bookingCount = $booking->get();
        $count = count($bookingCount);

        $bookings = $booking->paginate(200);
        return view('backend.booking.index', compact('bookings', 'count'));
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

    public function userBooking()
    {
        $booking = Booking::all();
        return view('frontend.user.includes.add_book', compact('booking'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amount = null;

        if (Auth::check()) {
            $user = auth()->user()->type;
            $carton_no = $request->carton_number;
            $carton = Carton::where('carton_number', $carton_no)->first();
            if ($carton) {
                $carton->carton_number = $request->carton_number ?? null;
                $carton->carton_weight = $request->carton_weight ?? null;
                $carton->shipping_method = $request->shipping_method ?? null;
                $carton->carton_status = $request->carton_status ?? null;
                $carton->save();
            } else {
                $createCarton = new Carton();
                $createCarton->carton_number = $request->carton_number ?? null;
                $createCarton->carton_weight = $request->carton_weight ?? null;
                $createCarton->shipping_method = $request->shipping_method ?? null;
                $createCarton->carton_status = $request->carton_status ?? null;
                $createCarton->save();
            }

            foreach ($request->othersProductName as $key => $value) {
                $createBooking = new Booking();

                $createBooking->date = $request->date[$key];
                $createBooking->user_id = auth()->user()->id ?? null;
                if ($carton) {
                    $createBooking->carton_id = $carton->id;
                } else {
                    $createBooking->carton_id = $createCarton->id ?? null;
                }

                $createBooking->ctnQuantity = $request->ctnQuantity[$key] ?? null;
                $createBooking->totalCbm = $request->totalCbm[$key] ?? null;
                $createBooking->productQuantity = $request->productQuantity[$key] ?? null;
                $createBooking->productsTotalCost = $request->productsTotalCost[$key] ?? null;
                $createBooking->othersProductName = $request->othersProductName[$key] ?? null;
                $createBooking->bookingProduct = $request->bookingProduct[$key] ?? null;
                $createBooking->delivery_method = $request->delivery_method[$key] ?? null;
                if (auth()->user()->type == 'user') {
                    $createBooking->customer_name = auth()->user()->name ?? null;
                    $createBooking->customer_phone = auth()->user()->phone ?? null;
                    if ($request->delivery_method[$key] == "on_address") {
                        $createBooking->customer_address = $request->customer_address[$key] ?? null;
                    } else {
                        $createBooking->customer_address = auth()->user()->address ?? null;
                    }
                }
                if (auth()->user()->type == 'admin') {
                    $createBooking->customer_name = $request->customer_name[$key] ?? null;
                    $createBooking->customer_phone = $request->customer_phone[$key] ?? null;
                    $createBooking->customer_address = $request->customer_address[$key] ?? null;
                }



                $createBooking->shipping_mark = $request->shipping_mark[$key] ?? null;
                $createBooking->shipping_number = $request->shipping_number[$key] ?? null;
                $createBooking->actual_weight = $request->actual_weight[$key] ?? null;
                $createBooking->unit_price = $request->unit_price[$key] ?? null;
                $createBooking->chinalocal = $request->chinalocal[$key] ?? null;
                $createBooking->packing_cost = $request->packing_cost[$key] ?? null;
                $createBooking->courier_bill = $request->courier_bill[$key] ?? null;

                $createBooking->paid = $request->paid[$key] ?? null;
                $createBooking->tracking_number = $request->tracking_number[$key] ?? null;
                $createBooking->remarks = $request->remarks[$key] ?? null;
                $createBooking->status = $request->status[$key] ?? null;
                $createBooking->save();
                $step = null;

                if ($request->status[$key]) {
                    $status = $request->status[$key];
                    $order_id = $createBooking->id;

                    if ($request->status[$key] == 'received-in-china-warehouse') {
                        $step = 1;
                    } elseif ($request->status[$key] == 'shipped-from-china-warehouse') {
                        $step = 2;
                    } elseif ($request->status[$key] == 'received-in-BD-warehouse') {
                        $step = 3;
                    } elseif ($request->status[$key] == 'delivered') {
                        $step = 4;
                    }
                    $createBooking->update([
                        'step' => $step,
                    ]);

                    $itemTrack = ItemTracking::where('item_number', $order_id)->where('step', $step)->first();

                    if ($itemTrack) {
                        $itemTrack->update(['step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
                    } else {
                        ItemTracking::insert(['item_number' => $order_id, 'step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
                    }
                }
            }

            if ($createBooking || $createCarton) {
                if ($user == 'user') {
                    return redirect()
                        ->back()
                        ->with('Createmessage', 'Your Booking Order Placed Successfully');
                } else {

                    return redirect()
                        ->route('admin.booking.index')
                        ->with('Createmessage', 'Your Booking Order Placed Successfully');
                }
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
        $booking = Booking::with('cartons')->findOrFail($id);

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
        $updateBooking = Booking::with('cartons')->findOrFail($id);

        $updateCarton = $updateBooking->cartons;

        if ($updateCarton->carton_number == $request->carton_number) {
            $updateCarton->carton_number = $request->carton_number ?? null;
            $updateCarton->carton_weight = $request->carton_weight ?? null;
            $updateCarton->shipping_method = $request->shipping_method ?? null;
            $updateCarton->carton_status = $request->carton_status ?? null;
            $updateCarton->save();
        } else {
            $createCarton = new Carton();
            $createCarton->carton_number = $request->carton_number ?? null;
            $createCarton->carton_weight = $request->carton_weight ?? null;
            $createCarton->shipping_method = $request->shipping_method ?? null;
            $createCarton->carton_status = $request->carton_status ?? null;
            $createCarton->save();
        }
        foreach ($request->othersProductName as $key => $value) {
            if ($value == $updateBooking->othersProductName) {

                $updateBooking->date = $request->date[$key];
                $updateBooking->user_id = $updateBooking->user_id ?? null;
                if ($updateCarton->carton_number == $request->carton_number) {
                    $updateBooking->carton_id = $updateCarton->id ?? null;
                } else {
                    $updateBooking->carton_id = $createCarton->id ?? null;
                }
                $updateBooking->ctnQuantity = $request->ctnQuantity[$key] ?? null;
                $updateBooking->totalCbm = $request->totalCbm[$key] ?? null;
                $updateBooking->productQuantity = $request->productQuantity[$key] ?? null;
                $updateBooking->productsTotalCost = $request->productsTotalCost[$key] ?? null;
                $updateBooking->othersProductName = $request->othersProductName[$key] ?? null;
                $updateBooking->bookingProduct = $request->bookingProduct[$key] ?? null;
                $updateBooking->delivery_method = $updateBooking->delivery_method ?? null;

                if ($request->customer_name[$key]) {
                    $updateBooking->customer_name = $request->customer_name[$key] ?? null;
                } else {
                    $updateBooking->customer_name = $updateBooking->customer_name ?? null;
                }
                if ($request->customer_phone[$key]) {
                    $updateBooking->customer_phone = $request->customer_phone[$key] ?? null;
                } else {
                    $updateBooking->customer_phone = $updateBooking->customer_phone ?? null;
                }
                if ($request->customer_address[$key]) {
                    $updateBooking->customer_address = $request->customer_address[$key] ?? null;
                } else {
                    $updateBooking->customer_address = $updateBooking->customer_address ?? null;
                }
                $updateBooking->shipping_mark = $request->shipping_mark[$key] ?? null;
                $updateBooking->shipping_number = $request->shipping_number[$key] ?? null;
                $updateBooking->actual_weight = $request->actual_weight[$key] ?? null;
                $updateBooking->unit_price = $request->unit_price[$key] ?? null;
                $updateBooking->chinalocal = $request->chinalocal[$key] ?? null;
                $updateBooking->packing_cost = $request->packing_cost[$key] ?? null;
                $updateBooking->courier_bill = $request->courier_bill[$key] ?? null;

                $updateBooking->amount = $request->amount[$key] ?? null;



                $updateBooking->paid = $request->paid[$key] ?? null;
                $updateBooking->tracking_number = $request->tracking_number[$key] ?? null;
                $updateBooking->remarks = $request->remarks[$key] ?? null;
                $updateBooking->status = $request->status[$key] ?? null;
                $updateBooking->save();

                $step = null;

                if ($request->status[$key]) {
                    $status = $request->status[$key];
                    $order_id = $updateBooking->id;

                    if ($request->status[$key] == 'received-in-china-warehouse') {
                        $step = 1;
                    } elseif ($request->status[$key] == 'shipped-from-china-warehouse') {
                        $step = 2;
                    } elseif ($request->status[$key] == 'received-in-BD-warehouse') {
                        $step = 3;
                    } elseif ($request->status[$key] == 'delivered') {
                        $step = 4;
                    }
                    $updateBooking->update([
                        'step' => $step,
                    ]);
                    // $updateBooking->step = $step;
                    $itemTrack = ItemTracking::where('item_number', $order_id)->where('step', $step)->first();

                    if ($itemTrack) {
                        $itemTrack->update(['step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
                    } else {
                        ItemTracking::insert(['item_number' => $order_id, 'step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
                    }
                }
            } else {
                $createBooking = new Booking();
                $createBooking->date = $request->date[$key];

                if ($updateCarton->carton_number == $request->carton_number) {
                    $createBooking->carton_id = $updateCarton->id ?? null;
                } else {
                    $createBooking->carton_id = $createCarton->id ?? null;
                }
                $createBooking->ctnQuantity = $request->ctnQuantity[$key] ?? null;
                $createBooking->totalCbm = $request->totalCbm[$key] ?? null;
                $createBooking->productQuantity = $request->productQuantity[$key] ?? null;
                $createBooking->productsTotalCost = $request->productsTotalCost[$key] ?? null;
                $createBooking->othersProductName = $request->othersProductName[$key] ?? null;
                $createBooking->bookingProduct = $request->bookingProduct[$key] ?? null;
                $createBooking->customer_name = $request->customer_name[$key] ?? null;
                $createBooking->customer_phone = $request->customer_phone[$key] ?? null;
                $createBooking->customer_address = $request->customer_address[$key] ?? null;
                $createBooking->shipping_mark = $request->shipping_mark[$key] ?? null;
                $createBooking->shipping_number = $request->shipping_number[$key] ?? null;
                $createBooking->actual_weight = $request->actual_weight[$key] ?? null;
                $createBooking->unit_price = $request->unit_price[$key] ?? null;
                $createBooking->chinalocal = $request->chinalocal[$key] ?? null;
                $createBooking->packing_cost = $request->packing_cost[$key] ?? null;
                $createBooking->courier_bill = $request->courier_bill[$key] ?? null;

                $createBooking->amount = $request->amount[$key] ?? null;

                $createBooking->paid = $request->paid[$key] ?? null;
                $createBooking->tracking_number = $request->tracking_number[$key] ?? null;
                $createBooking->remarks = $request->remarks[$key] ?? null;
                $createBooking->status = $request->status[$key] ?? null;
                $createBooking->save();
                if ($request->status[$key]) {
                    $step = null;
                    $status = $request->status[$key];
                    $order_id = $createBooking->id;

                    if ($status == 'received-in-china-warehouse') {
                        $step = 1;
                    } elseif ($status == 'shipped-from-china-warehouse') {
                        $step = 2;
                    } elseif ($status == 'received-in-BD-warehouse') {
                        $step = 3;
                    } elseif ($status == 'delivered') {
                        $step = 4;
                    }
                    $createBooking->update([
                        'step' => $step,
                    ]);
                    $itemTrack = ItemTracking::where('item_number', $order_id)->where('step', $step)->first();

                    if ($itemTrack) {
                        $itemTrack->update(['step' =>  $$step, 'status' => $status, 'step_change_date' => now()]);
                    } else {
                        ItemTracking::insert(['item_number' => $order_id, 'step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
                    }
                }
            }
        }

        return redirect()
            ->route('admin.booking.index')
            ->with('Updatemessage', 'Booking Order Updated Successfully');
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
        if ($booking) {
            $booking->delete($booking);
        }
        return redirect()
            ->back()
            ->withFlashSuccess('Booking Deleted Successfully');
    }
    public function statusUpdate(Request $request)
    {
        foreach ($request->booking_id as $key => $value) {
            $step = null;
            $booking = Booking::with('cartons')->findOrFail($value);
            $booking->status = $request->status;
            if ($request->status) {
                if ($request->status == 'received-in-china-warehouse') {
                    $step = 1;
                } elseif ($request->status == 'shipped-from-china-warehouse') {
                    $step = 2;
                } elseif ($request->status == 'received-in-BD-warehouse') {
                    $step = 3;
                } elseif ($request->status == 'delivered') {
                    $step = 4;
                }
                $booking->step = $step;
            }



            $status = $request->status;
            $order_id = $value;

            if ($status === 'received-in-china-warehouse') {
                $step = 1;
            } elseif ($status === 'shipped-from-china-warehouse') {
                $step = 2;
            } elseif ($status === 'received-in-BD-warehouse') {
                $step = 3;
            } elseif ($status === 'delivered') {
                $step = 4;
            }
            $itemTrack = ItemTracking::where('item_number', $value)->where('step', $step)->first();

            if ($itemTrack) {
                $itemTrack->update(['step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
            } else {
                ItemTracking::insert(['item_number' => $order_id, 'step' =>  $step, 'status' => $status, 'step_change_date' => now()]);
            }
            $booking->save();
        }
        return redirect()
            ->back()
            ->withFlashSuccess('Booking Status Updated Successfully');
    }

    public function bookingDataValidate()
    {
        return request()->validate([
            'date' => 'nullable|date',
            'carton_id' => 'nullable|numeric',
            'ctnQuantity' => 'nullable|numeric',
            'totalCbm' => 'nullable|numeric',
            'productQuantity' => 'nullable|numeric',
            'productsTotalCost' => 'nullable|between:0,99.99',
            'othersProductName.*' => 'nullable|string',
            'bookingProduct' => 'nullable|string',
            'shipping_mark' => 'nullable|string',
            'shipping_number' => 'nullable|string',
            'actual_weight' => 'nullable|string',
            'unit_price' => 'nullable|string',
            'chinalocal' => 'nullable|string',
            'packing_cost' => 'nullable|string',
            'courier_bill' => 'nullable|string',
            'amount' => 'nullable|string',
            'paid' => 'nullable|string',
            'tracking_number' => 'nullable|string',
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
            'carton_number' => 'nullable|string',
            'product_total_weight' => 'nullable|string',
            'carton_weight' => 'nullable|string',
            'carton_status' => 'nullable|string',
            'shipping_method' => 'nullable|string',
        ]);
    }
}
