<?php

namespace App\Http\Controllers\Backend\content;

use App\Http\Controllers\Controller;
use App\Traits\ApiAccountTrait;
use App\Traits\PaginationTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    use ApiAccountTrait, PaginationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function skybuyIndex()
    {
        return view('backend.accounts.skybuy.index');
    }

    public function skybuyTable()
    {
        $filter = [
            'item_number' => request('item_number', null),
            'status' => request('status', null),
            'recap_report' => request('recap_report', null),
            'from_date' => request('from_date', null),
            'to_date' => request('to_date', null),
        ];

        $receivedData = $this->skybuyTableTrait($filter);
        $accountsData = $receivedData->data->result;
        $account = $accountsData->data;

        $accounts = $this->paginate($account, 20);
        $accounts->withPath('');
        return view('backend.accounts.skybuy.skybuyAccountsTable', compact('accounts'));
    }

    public function skyoneIndex()
    {
        return view('backend.accounts.skyone.index');
    }

    public function skyoneTable()
    {
        return view('backend.accounts.skyone.skyoneAccountsTable');
    }
}
