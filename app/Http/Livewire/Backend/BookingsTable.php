<?php

namespace App\Http\Livewire\Backend;

use App\Models\Content\Booking;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BookingsTable extends DataTableComponent
{
    use HtmlComponents;
    /**
     * @var string
     */

    public function query(): Builder
    {
        return Booking::with('user', 'cartons')->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Date', 'date')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return date('d/m/Y', strtotime($row->date));
                }),

            Column::make('Customer', 'customer_name')->searchable(),

            Column::make('Customer Phone', 'customer_phone')->searchable(),

            Column::make('Products Name', 'othersProductName')->searchable(),

            Column::make('Products Cost', 'productsTotalCost'),

            Column::make('Quantity', 'productQuantity'),

            Column::make('CBM', 'totalCbm'),

            Column::make('Carton Quantity', 'ctnQuantity'),

            Column::make('Shipping Mark', 'shipping_mark')->searchable(),
            Column::make('Carton Number', 'cartons.carton_number')->searchable(),
            Column::make('Shipping Number', 'shipping_number')->searchable(),

            Column::make('Actual Weight', 'actual_weight'),

            Column::make('Unit Price', 'unit_price'),

            Column::make('Remarks', 'remarks'),

            Column::make('Status', 'status')->searchable(),

            Column::make(__('Action'), 'action')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                return view('backend.booking.includes.actions')->withbooking($row);
            }),
        ];
    }
}
