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
        return $product = Product::with('warehouse', 'status', 'shipping', 'user');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'asc');
    }

    public function columns(): array
    {

        return [

            Column::make('Invoice', 'invoice')
                ->searchable()
                ->sortable(),

            Column::make('Product Name', 'productName')
                ->searchable(),

            Column::make('Status', 'status.name')
                ->searchable(),

            Column::make('Warehouse', 'warehouse.name')
                ->searchable(),

            Column::make('Shipping Type', 'shipping.name')
                ->searchable(),

            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.products.product.includes.actions')->withproduct($row);
                }),
        ];
    }
}
