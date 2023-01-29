<?php

namespace App\Http\Livewire\Backend;

use App\Models\Content\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InvoicesTable extends DataTableComponent
{
    use HtmlComponents;
    /**
     * @var string
     */

    public function query(): Builder
    {
        return Invoice::with('user')->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Date', 'created_at')
                ->searchable()->format(
                    function ($value, $column, $row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    }
                ),
            Column::make('InvoiceNo', 'invoice_id')
                ->searchable()
                ->format(function ($value, $column, $row) {
                    $href = '<a href="' . route('admin.invoice.details', $row) . '" target="_blank">' . $row->invoice_id . '</a>';
                    return $this->html($href);
                }),

            Column::make('Customer Name', 'customer_name')->searchable(),
            Column::make('Customer Phone', 'customer_phone')->searchable(),
            Column::make('Delivery Method', 'delivery_method')->searchable(),
            Column::make('Amount', 'amount'),
            Column::make('Courier Bill', 'total_courier'),
            Column::make('Paid', 'paid'),

            Column::make('Due', 'due')->format(function ($value, $column, $row) {
                $amount = $row->amount;
                $paid = $row->paid;
                $courier = $row->total_courier;
                $due = $amount - $paid + $courier;

                return $due;
            }),

            Column::make('Payment Method', 'payment_method')->searchable(),
            Column::make('Status', 'status')->searchable(),
            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.invoice.includes.actions', ['invoice' => $row]);
                }),



        ];
    }
}
