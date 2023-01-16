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

        $accountsData = $this->recentorderListTrait($filter);
        $account = [];
        $totalcount = 0;
        $processing = 0;
        $purchased = 0;
        $partial = 0;
        $delivered = 0;
        $received_in_bd = 0;
        $received_in_china = 0;
        $shipped_from_china = 0;
        $products_value = 0;
        $bd_receive = 0;
        $bd_out = 0;


        if ($accountsData) {
            $acc = $accountsData->data->result->data;
            foreach ($acc as $ac) {
                if ($ac->status != 'Waiting for Payment') {
                    $account[] = $ac;
                }
            }
            $totalcount = count($account);
            foreach ($account as $data) {
                if ($data->status == 'processing') {
                    $processing += 1;
                }
                if ($data->status == 'purchased') {
                    $purchased += 1;
                }
                if ($data->status == 'partial-paid') {
                    $partial += 1;
                }
                if ($data->status == 'delivered') {
                    $delivered += 1;
                }
                if ($data->status == 'received-in-BD-warehouse') {
                    $received_in_bd += 1;
                }
                if ($data->status == 'received-in-china-warehouse') {
                    $received_in_china += 1;
                }
                if ($data->status == 'shipped-from-china-warehouse') {
                    $shipped_from_china += 1;
                }

                $products_value += $data->product_value;
                $bd_receive += $data->product_bd_received_cost;
                $bd_out +=  $data->purchase_cost_bd;
            }
        }
        $accounts = $this->paginate($account, 6);
        $accounts->withPath('');
        return view('backend.accounts.skybuy.index', compact('accounts', 'totalcount', 'processing', 'purchased', 'partial', 'delivered', 'products_value', 'bd_receive', 'bd_out', 'received_in_bd', 'received_in_china', 'shipped_from_china'));
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

        $accountsData = $this->recentorderListTrait($filter);

        $account = [];
        $total = 0;
        $totalcount = 0;
        $products_value = 0;
        $total_bd_receive = 0;
        $total_bd_out = 0;
        if ($accountsData) {
            $acc = $accountsData->data->result->data;
            foreach ($acc as $ac) {
                if ($ac->status != 'Waiting for Payment') {
                    $account[] = $ac;
                }
            }
            $totalcount = count($account);
            foreach ($account as $data) {
                $products_value += $data->product_value;
                $total_bd_receive += $data->product_bd_received_cost;
                $total_bd_out += $data->purchase_cost_bd;
            }
        }
        $accounts = $this->paginate($account, 30);
        $accounts->withPath('');
        return view('backend.accounts.skybuy.skybuyAccountsTable', compact('accounts', 'products_value', 'total_bd_receive', 'total_bd_out', 'totalcount'));
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
