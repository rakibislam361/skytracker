<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Products\Models\Product;
use App\Domains\Products\Models\Warehouse;
use Illuminate\Http\Request;
use DB;

/**
 * Class TermsController.
 */
class TrackingController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.pages.tracking');
    }



    public function Track(Request $request)
    {
        $data = Product::with('warehouse', 'status');

        if ($request->input('trackid')) {
            $data = $data->where('invoice', 'LIKE', "" . $request->trackid . "")->paginate(10);
        }
        return view('frontend.pages.tracking', compact('data'));
    }
}
