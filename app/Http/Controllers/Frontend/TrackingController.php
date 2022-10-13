<?php

namespace App\Http\Controllers\Frontend;

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
        $data = DB::table('products');
        if ($request->input('trackid')) {
            $data = $data->where('id', 'LIKE', "%" . $request->trackid . "%");
        }
        $data = $data->paginate(10);
        return view('frontend.pages.tracking', compact('data'));
    }
}
