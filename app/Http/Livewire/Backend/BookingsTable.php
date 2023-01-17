<?php

namespace App\Http\Livewire\Backend;

use App\Models\Content\booking;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BookingsTable extends DataTableComponent
{

    /**
     * @return Builder
     */
    public function query(): Builder
    {

        return booking::with('user')->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Date', 'date')
                ->sortable()
                ->searchable(),

            Column::make('Customer', 'user.name')->searchable(),

            Column::make('Products Name', 'othersProductName')
                ->searchable(),

            Column::make('Products Cost', 'productsTotalCost'),

            Column::make('Quantity', 'productQuantity'),

            Column::make('CBM', 'totalCbm'),

            Column::make('Carton Quantity', 'ctnQuantity'),

            Column::make('Shipping Mark', 'shipping_mark')
                ->searchable(),

            Column::make('Carton Number', 'carton_number')
                ->searchable(),

            Column::make('Shipping Number', 'shipping_number')
                ->searchable(),

            Column::make('Actual Weight', 'actual_weight'),

            Column::make('Unit Price', 'unit_price'),

            Column::make('Amount', 'amount'),


            Column::make('Tracking Number', 'tracking_id')
                ->searchable(),

            Column::make('Remarks', 'remarks'),

            Column::make('Status', 'status')
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.booking.includes.actions')->withbooking($row);
                }),
        ];
    }
}
