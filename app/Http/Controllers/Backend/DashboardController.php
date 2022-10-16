<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use DB;

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
        return view('backend.dashboard');
    }

    public function search(Request $request)
    {

        $data = DB::table('products');
        if ($request->input('search')) {
            $data = $data->where('id', 'LIKE', "%" . $request->search . "%");
        }
        $data = $data->paginate(10);
        return view('backend.dashboard', compact('data'));
    }
}
