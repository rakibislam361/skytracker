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
        $filter = [
            'item_number' => request('item_number', null),
            'status' => request('status', null),
            'recap_report' => request('recap_report', null),
            'from_date' => request('from_date', null),
            'to_date' => request('to_date', null),
        ];

        $receivedData = $this->recentorderListTrait($filter);
        $accountsData = $receivedData;
        $account = $accountsData->data->result->data;
        $acc = [];
        $totalcount = 0;
        $waiting = 0;
        $processing = 0;
        $delivered = 0;
        $purchased = 0;
        $pending = 0;

        foreach ($account as $data) {
            $acc[] = $data;
            $count = count($acc);
            $totalcount += $count;
        }
        foreach ($account as $data) {
            if ($data->status == 'Waiting for Payment') {
                $acc[] = $data;
                $count = count($acc);
                $waiting += $count;
            }
        }
        foreach ($account as $data) {
            if ($data->status == 'processing') {
                $acc[] = $data;
                $count = count($acc);
                $processing += $count;
            }
        }
        foreach ($account as $data) {
            if ($data->status == 'delivered') {
                $acc[] = $data;
                $count = count($acc);
                $delivered += $count;
            }
        }
        foreach ($account as $data) {
            if ($data->status == 'purchased') {
                $acc[] = $data;
                $count = count($acc);
                $purchased += $count;
            }
        }
        foreach ($account as $data) {
            if ($data->status == 'on-hold') {
                $acc[] = $data;
                $count = count($acc);
                $pending += $count;
            }
        }


        $accounts = $this->paginate($account, 30);
        $accounts->withPath('');
        return view('backend.accounts.skybuy.index', compact('accounts', 'totalcount', 'waiting', 'processing', 'delivered', 'purchased', 'pending'));
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
        $total = 0;
        $total_bd_receive = 0;
        $total_bd_out = 0;
        $account = [];
        foreach ($accountsData->data as $data) {
            if ($data->status != 'Waiting for Payment') {
                $account[] = $data;
            }
        }

        foreach ($account as $accounts) {

            $bdReceive = $accounts->product_bd_received_cost;
            $bdOut = $accounts->purchase_cost_bd;
            $pl = $bdReceive - $bdOut;
            $total += $pl;
            $total_bd_receive += $bdReceive;
            $total_bd_out += $bdOut;
        }

        $accounts = $this->paginate($account, 20);
        $accounts->withPath('');
        return view('backend.accounts.skybuy.skybuyAccountsTable', compact('accounts', 'total', 'total_bd_receive', 'total_bd_out'));
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
