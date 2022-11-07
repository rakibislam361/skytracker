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
        // $warehouses = Warehouse::all();

        // $warehouse = Warehouse::find('warehouses.id');

        // $products = Product::select('products.warehouse_id')->join('warehouses', 'warehouses.id', '=', 'products.warehouse_id')->get();
        // dd($warehouses);
        return product::with('user:id,name')->latest();
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

            Column::make('Status', 'status')
                ->searchable(),

            Column::make('Warehouse', 'warehouse_id')
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.products.product.includes.actions')->withproduct($row);
                }),
        ];
    }
}
