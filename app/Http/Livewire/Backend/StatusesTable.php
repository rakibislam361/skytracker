<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Products\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class StatusesTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return product::with('user:id,name')->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Invoice', 'invoice')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->searchable(),
            Column::make('Warehouse', 'warehouse')
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.products.status.includes.actions')->withstatus($row);
                }),
        ];
    }
}
