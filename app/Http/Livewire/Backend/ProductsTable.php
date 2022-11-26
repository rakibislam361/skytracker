<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Products\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class ProductsTable  extends DataTableComponent
{
    /**
     
     * @return Builder
     */

    public function query(): Builder
    {

        return Product::with('warehouse', 'status', 'shipping', 'user');
    }


    public function columns(): array
    {

        return [
            Column::make('Date', 'created_at')
                ->searchable(),

            Column::make('Item Number',)
                ->searchable()
                ->sortable(),

            Column::make('BD Receive',)
                ->searchable(),

            Column::make('Purchase Cost(BDT)',)
                ->searchable(),

            Column::make('Status',)
                ->searchable(),

            Column::make('Profit',)
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.products.product.includes.actions')->withproduct($row);
                }),
        ];
    }
}
