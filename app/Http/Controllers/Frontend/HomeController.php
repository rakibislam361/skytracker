<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Products\Models\Product;
use App\Models\Content\Booking;
use App\Models\Content\Carton;
use Illuminate\Http\Request;
use App\Models\Info;
use App\Models\Notice;
use App\Models\Page;

class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $product = Product::all();
        return view('frontend.index', compact('product'));
    }
    public function noticedetails($id)
    {
        $notice = Notice::find($id);
        return view('frontend.content.noticedetails', compact('notice'));
    }
    public function infodetails($id)
    {
        $info = Info::find($id);

        return view('frontend.content.infodetails', compact('info'));
    }
    public function noticeall()
    {
        $notices = Notice::orderBy('id', 'DESC')->get();
        return view('frontend.content.noticeall', compact('notices'));
    }
    public function infoall()
    {
        $infos = Info::orderBy('id', 'DESC')->get();
        return view('frontend.content.infoall', compact('infos'));
    }
    public function pageshow($slug)
    {
        $page = Page::where('slug', $slug)->get()->first();
        return view('frontend.content.dynamicpage', compact('page'));
    }

    public function trackOrder()
    {
        return view('frontend.pages.tracking');
    }

    public function trackOrderFormSubmit(Request $request)
    {
        $id = $request->tracking_id ?? null;

        $bookings = Booking::where('tracking_number', $id)->with('itemTrackStatus')->first();

        if ($bookings) {
            return view('frontend.content.trackBookingForm', compact('bookings'));
        }

        // return redirect()->back()->withFlashDanger("Oops! Can't find any Item");
        return redirect()
            ->back()
            ->with('message', 'Sorry!! Cannot Find any Product');
    }
}
