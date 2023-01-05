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

        return booking::with('user:id')->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Date', 'date')
                ->sortable()
                ->searchable(),

            Column::make('Products Name', 'othersProductName')
                ->searchable(),

            Column::make('Products Cost', 'productsTotalCost'),

            Column::make('Quantity', 'productQuantity'),

            Column::make('CBM', 'totalCbm')
                ->searchable(),

            Column::make('Carton Quantity', 'ctnQuantity')
                ->searchable(),
            Column::make('Image', 'bookingProduct'),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.booking.includes.actions')->withbooking($row);
                }),
        ];
    }
}
