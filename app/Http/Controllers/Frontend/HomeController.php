<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Products\Models\Product;

/**
 * Class HomeController.
 */
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
}
