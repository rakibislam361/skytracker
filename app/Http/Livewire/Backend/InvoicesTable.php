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
        return Invoice::with('user');
    }

    public function columns(): array
    {
        return [
            Column::make('Date', 'created_at')
                ->sortable()
                ->searchable()->format(
                    function ($value, $column, $row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    }
                ),
            Column::make('InvoiceNo', 'invoice_id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    $href = '<a href="' . route('admin.invoice.details', $row) . '" target="_blank">' . $row->invoice_id . '</a>';
                    return $this->html($href);
                }),

            Column::make('Customer Name', 'customer_name')->searchable(),
            Column::make('Customer Phone', 'customer_phone')->searchable(),
            Column::make('Delivery Method', 'delivery_method')->searchable(),
            Column::make('Total Payable', 'total_payable'),
            Column::make('Total Due', 'total_due'),
            Column::make('Total Payable', 'total_payable'),
            Column::make('Payment Method', 'payment_method')->searchable(),
            Column::make('Status', 'status')->searchable(),
            Column::make(__('Action'), 'action')
            // ->format(function ($value, $column, $row) {
            //     return view('', ['invoice' => $row]);
            // }),



        ];
    }
}
