<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Content\Booking;
use App\Models\Content\Invoice;
use App\Models\Content\Carton;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use Auth;


/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [];
        // $null = null;
        $user = auth()->user()->id;
        $phone = auth()->user()->phone ?? 'helLo';
        $book = Booking::with('cartons', 'user')->latest()->get();
        foreach ($book as $key => $value) {
            // dd($value);
            if ($value->customer_phone != null) {
                $data[] = $value->customer_phone;
            }
        }
        // if ($phone = null) {
        //     $phone = 0;
        // }
        // dd($data);
        // if ($phone != null) {
        // $booking = Booking::with('cartons', 'user')->whereNotIn('customer_phone', $data)->where('user_id', $user)->orWhere('customer_phone', $phone)->latest()->get();
        $booking = Booking::with('cartons', 'user')->where('user_id', $user)->orWhere('customer_phone', '=', $phone)->latest()->get();
        $invoice = Invoice::where('user_id', $user)->orWhere('customer_phone', $phone)->latest()->get();
        // } else {
        //     $booking = [];
        //     $invoice = [];
        // }
        return view('frontend.user.dashboard', compact('booking', 'invoice'));
    }

    public function bookings()
    {
        $user = auth()->user()->id;
        $phone = auth()->user()->phone ?? 'helLo';


        // if ($phone != null) {
        $bookings = Booking::with('cartons', 'user')->where('user_id', $user)->orWhere('customer_phone', '=', $phone)->latest();

        $booking = $bookings->paginate(10);
        // } else {
        //     $booking = [];
        // }

        return view('frontend.user.myBooking', compact('booking'));
    }
    public function invoices()
    {
        $user = auth()->user()->id;
        $phone = auth()->user()->phone ?? 'helLo';
        // if ($phone != null) {
        $invoices = Invoice::where('user_id', $user)->orWhere('customer_phone', $phone)->latest();

        $invoice = $invoices->paginate(10);
        // } else {
        //     $invoice = [];
        // }
        return view('frontend.user.myInvoices', compact('invoice'));
    }
    public function details($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.user.invoice', compact('invoice'));
    }
}
