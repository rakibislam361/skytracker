<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use App\Traits\ApiOrderTrait;
use Illuminate\Support\Facades\Log;
use App\Models\Content\OrderItem;

/**
 * Class Kernel.
 */
class Kernel extends ConsoleKernel
{
    use ApiOrderTrait;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \app\Console\Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('activitylog:clean')->daily();
        // $schedule->call(function () {
        //     $filter = [
        //         'item_number' => request('item_number', null),
        //         'carton_id' => request('carton_id', null),
        //         'customer' => request('customer', null),
        //         'status' => request('status', null),
        //         'shipping_from' => request('shipping_from', null),
        //         'from_date' => request('from_date', null),
        //         'to_date' => request('to_date', null),
        //     ];
        //     $receivedData = $this->orderList($filter);
        //     $ordersData = $receivedData->data->result->data;
        //     // Log::info($ordersData);
        //     foreach ($ordersData as $data) {
        //         $data = (array)$data;
        //         $user = $data['user'];
        //         $user_arr = json_decode(json_encode($user), true);
        //         $name = isset($user_arr['name']) ? $user_arr['name'] : null;
        //         $first_name = isset($user_arr['first_name']) ? $user_arr['first_name'] : null;
        //         $last_name = isset($user_arr['last_name']) ? $user_arr['last_name'] : null;
        //         $email = isset($user_arr['email']) ? $user_arr['email'] : null;
        //         $phone = isset($user_arr['phone']) ? $user_arr['phone'] : null;

        //         OrderItem::updateOrCreate(
        //             ['id' => $data['id']],
        //             [
        //                 'id' => $data['id'],
        //                 'order_item_number' => $data['order_item_number'],
        //                 'order_id' => $data['order_id'],
        //                 'product_id' => $data['product_id'],
        //                 'name' => $data['name'],
        //                 'link' => $data['link'],
        //                 'image' => $data['image'],
        //                 'quantityRanges' => $data['quantityRanges'],
        //                 'shipping_from' => $data['shipping_from'],
        //                 'shipped_by' => $data['shipped_by'],
        //                 'shipping_rate' => $data['shipping_rate'],
        //                 'shipping_mark' => $data['shipping_mark'],
        //                 'approxWeight' => $data['approxWeight'],
        //                 'chinaLocalDelivery' => $data['chinaLocalDelivery'],
        //                 'china_local_delivery_rmb' => $data['china_local_delivery_rmb'],
        //                 'order_number' => $data['order_number'],
        //                 'order_item_rmb' => $data['order_item_rmb'],
        //                 'product_type' => $data['product_type'],
        //                 'tracking_number' => $data['tracking_number'],
        //                 'cbm' => $data['cbm'],
        //                 'carton_id' => $data['carton_id'],
        //                 'chn_warehouse_weight' => $data['chn_warehouse_weight'],
        //                 'chn_warehouse_qty' => $data['chn_warehouse_qty'],
        //                 'actual_weight' => $data['actual_weight'],
        //                 'quantity' => $data['quantity'],
        //                 'product_value' => $data['product_value'],
        //                 'purchase_cost_bd' => $data['purchase_cost_bd'],
        //                 'purchase_rmb' => $data['purchase_rmb'],
        //                 'product_bd_received_cost' => $data['product_bd_received_cost'],
        //                 'first_payment' => $data['first_payment'],
        //                 'coupon_contribution' => $data['coupon_contribution'],
        //                 'shipping_charge' => $data['shipping_charge'],
        //                 'delivery_method' => $data['delivery_method'],
        //                 'courier_bill' => $data['courier_bill'],
        //                 'out_of_stock' => $data['out_of_stock'],
        //                 'out_of_stock_type' => $data['out_of_stock_type'],
        //                 'missing' => $data['missing'],
        //                 'adjustment' => $data['adjustment'],
        //                 'refunded' => $data['refunded'],
        //                 'last_payment' => $data['last_payment'],
        //                 'due_payment' => $data['due_payment'],
        //                 'invoice_no' => $data['invoice_no'],
        //                 'feedback' => $data['feedback'],
        //                 'remarks' => $data['remarks'],
        //                 'claim' => $data['claim'],
        //                 'solution' => $data['solution'],
        //                 'status' => $data['status'],
        //                 'step' => $data['step'],
        //                 'user_id' => $data['user_id'],
        //                 'user_name' => $name,
        //                 'first_name' => $first_name,
        //                 'last_name' => $last_name,
        //                 'email' => $email,
        //                 'phone' => $phone,
        //                 'created_at' => $data['created_at'],
        //                 'updated_at' => $data['updated_at'],
        //                 'deleted_at' => $data['deleted_at'],
        //             ]
        //         );
        //     }
        // })->everyMinute();

        // $schedule->command('demo:cron')
        //     ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
