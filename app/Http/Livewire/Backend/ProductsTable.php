<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Products\Models\Product;
use App\Domains\Products\Models\Warehouse;
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
        return Product::with('warehouse', 'status');
    }


    public function columns(): array
    {

        return [

            Column::make('Invoice', 'invoice')
                ->searchable(),

            Column::make('Name', 'productName')
                ->searchable(),

            Column::make('Shipping Type', 'shipping_type')
                ->searchable(),

            Column::make('Status', 'status.name')
                ->searchable(),

            Column::make('Warehouse', 'warehouse.name')
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.products.product.includes.actions')->withproduct($row);
                }),
        ];
    }
}
