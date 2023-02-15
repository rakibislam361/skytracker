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
        return view('frontend.user.dashboard');
    }

    public function bookings()
    {
        $user = auth()->user()->id;
        $booking = Booking::with('cartons', 'user')->where('user_id', $user)->latest()->get();
        return view('frontend.user.myBooking', compact('booking'));
    }
    public function invoices()
    {
        $user = auth()->user()->id;
        $invoice = Invoice::where('user_id', $user)->latest()->get();
        return view('frontend.user.myInvoices', compact('invoice'));
    }
    public function details($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.user.invoice', compact('invoice'));
    }
}
