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
        $user = auth()->user()->id;
        $phone = auth()->user()->phone;
        $booking = Booking::with('cartons', 'user')->where('user_id', $user)->orWhere('customer_phone', $phone)->latest()->get();
        $invoice = Invoice::where('user_id', $user)->orWhere('customer_phone', $phone)->latest()->get();
        return view('frontend.user.dashboard', compact('booking', 'invoice'));
    }

    public function bookings()
    {
        $user = auth()->user()->id;
        $phone = auth()->user()->phone;
        $bookings = Booking::with('cartons', 'user')->where('user_id', $user)->orWhere('customer_phone', $phone)->latest();

        $booking = $bookings->paginate(10);
        return view('frontend.user.myBooking', compact('booking'));
    }
    public function invoices()
    {
        $user = auth()->user()->id;
        $phone = auth()->user()->phone;
        $invoices = Invoice::where('user_id', $user)->orWhere('customer_phone', $phone)->latest();

        $invoice = $invoices->paginate(10);
        return view('frontend.user.myInvoices', compact('invoice'));
    }
    public function details($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.user.invoice', compact('invoice'));
    }
}
