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
                ->searchable()->format(
                    function ($value, $column, $row) {
                        return date('d/m/Y', strtotime($row->date));
                    }
                ),

            Column::make('Customer', 'customer_name')->searchable(),

            Column::make('Customer Phone', 'customer_phone')->searchable(),

            Column::make('Products Name', 'othersProductName')->searchable(),

            Column::make('Products Cost', 'productsTotalCost'),

            Column::make('Quantity', 'productQuantity'),

            Column::make('CBM', 'totalCbm'),

            Column::make('Carton Quantity', 'ctnQuantity'),

            Column::make('Shipping Mark', 'shipping_mark')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                $shipping_mark = null;
                foreach ($carton as $key => $value) {
                    $shipping_mark = $value->shipping_mark;
                }
                return $shipping_mark;
            }),
            Column::make('Carton Number', 'carton_number')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                $carton_number = null;
                foreach ($carton as $key => $value) {
                    $carton_number = $value->carton_number;
                }
                return $carton_number;
            }),
            Column::make('Shipping Number', 'shipping_number')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                $shipping_number = null;
                foreach ($carton as $key => $value) {
                    $shipping_number = $value->shipping_number;
                }
                return $shipping_number;
            }),

            Column::make('Tracking Number', 'tracking_id')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                $tracking_id = null;
                foreach ($carton as $key => $value) {
                    $tracking_id = $value->tracking_id;
                }
                return $tracking_id;
            }),


            Column::make('Actual Weight', 'actual_weight')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                $actual_weight = null;
                foreach ($carton as $key => $value) {
                    $actual_weight = $value->actual_weight;
                }
                return $actual_weight;
            }),
            Column::make('Total Weight', 'total_weight')->format(function ($value, $column, $row) {
                $carton = $row->cartons;
                $total_weight = null;
                foreach ($carton as $key => $value) {
                    $total_weight = $value->total_weight;
                }
                return $total_weight;
            }),

            Column::make('Unit Price', 'unit_price'),

            Column::make('Amount', 'amount'),
            Column::make('Paid', 'paid'),

            Column::make('Remarks', 'remarks'),

            Column::make('Status', 'status')->searchable(),

            Column::make(__('Action'), 'action')->format(function ($value, $column, $row) {
                return view('backend.booking.includes.actions')->withbooking($row);
            }),
        ];
    }
}
