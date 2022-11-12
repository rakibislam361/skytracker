<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Products\Models\Shipping;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */

class ShippingsTable extends DataTableComponent

{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Shipping::with('user:id,name')->latest();
    }

    public function columns(): array
    {
        return [

            Column::make('Shipping Type', 'name')
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.products.shipping.includes.actions')->withshipping($row);
                }),
        ];
    }
}
