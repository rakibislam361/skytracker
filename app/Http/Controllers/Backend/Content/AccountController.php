<?php

namespace App\Http\Controllers\Backend\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('backend.accounts.skybuy.index');
    }

    public function show()
    {
        return view('backend.accounts.skybuy.table');
    }
}
