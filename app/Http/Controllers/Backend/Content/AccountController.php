<?php

namespace App\Http\Controllers\Backend\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function skybuyIndex()
    {
        return view('backend.accounts.skybuy.index');
    }

    public function skybuyTable()
    {
        return view('backend.accounts.skybuy.skybuyAccountsTable');
    }

    public function skyoneIndex()
    {
        return view('backend.accounts.skybuy.index');
    }
}
