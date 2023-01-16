<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Models\Content\Order;
use App\Models\Content\Setting;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
  use DisableForeignKeys;

  /**
   * Run the database seed.
   */
  public function run()
  {
    $this->disableForeignKeys();

    // Create Roles
    Role::create([
      'id' => 1,
      'type' => User::TYPE_ADMIN,
      'name' => 'Administrator',
    ]);

    Role::create([
      'id' => 2,
      'type' => User::TYPE_USER,
      'name' => 'Customer',
    ]);

    // Non Grouped Permissions
    //

    // Grouped permissions
    // Users category
    $users = Permission::create([
      'type' => User::TYPE_ADMIN,
      'name' => 'admin.access.user',
      'description' => 'All User Permissions',
    ]);

    $users->children()->saveMany([
      new Permission([
        'type' => User::TYPE_ADMIN,
        'name' => 'admin.access.user.list',
        'description' => 'View Users',
      ]),
      new Permission([
        'type' => User::TYPE_ADMIN,
        'name' => 'admin.access.user.deactivate',
        'description' => 'Deactivate Users',
        'sort' => 2,
      ]),
      new Permission([
        'type' => User::TYPE_ADMIN,
        'name' => 'admin.access.user.reactivate',
        'description' => 'Reactivate Users',
        'sort' => 3,
      ]),
      new Permission([
        'type' => User::TYPE_ADMIN,
        'name' => 'admin.access.user.clear-session',
        'description' => 'Clear User Sessions',
        'sort' => 4,
      ]),
      new Permission([
        'type' => User::TYPE_ADMIN,
        'name' => 'admin.access.user.impersonate',
        'description' => 'Impersonate Users',
        'sort' => 5,
      ]),
      new Permission([
        'type' => User::TYPE_ADMIN,
        'name' => 'admin.access.user.change-password',
        'description' => 'Change User Passwords',
        'sort' => 6,
      ]),
    ]);

    // Assign Permissions to other Roles
    //
    $orders = Permission::create([
      'type' => Order::TYPE_ADMIN,
      'name' => 'admin.order',
      'description' => 'Edit All Order Permissions',
    ]);
    $orders->children()->saveMany([
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.order_rmb',
        'description' => 'Edit Order Rmb',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.purchase',
        'description' => 'Actual Cost(Purchase Cost)',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.localdelivery',
        'description' => 'Edit Local Delivery',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.product_type',
        'description' => 'Edit Product Type',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.shipping_from',
        'description' => 'Edit Shipping From(GZ/HK)',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.shipping_mark',
        'description' => 'Edit Shipping Mark',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.chn_warehouse_qty',
        'description' => 'Edit China Warehouse Quantity',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.chn_warehouse_weight',
        'description' => 'Edit China Warehouse Weight',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.cbm.edit',
        'description' => 'Edit Cbm',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.carton_id',
        'description' => 'Edit Carton Number',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.shipped_by',
        'description' => 'Edit Shipped By(air/sea)',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.tracking_id',
        'description' => 'Edit Tracking Number',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.processing',
        'description' => 'Edit Status processing',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.on-hold',
        'description' => 'Edit Status on-hold',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.purchased',
        'description' => 'Edit Status purchase completed',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.re-order',
        'description' => 'Edit Status re-order',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.refund-please',
        'description' => 'Edit Status refund-please',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.shipped-from-suppliers',
        'description' => 'Edit Status shipped-from-suppliers',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.delivery-after-holiday',
        'description' => 'Edit Status delivery-after-holiday',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.received-in-china-warehouse',
        'description' => 'Edit Status received-in-china-warehouse',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.shipped-from-china-warehouse',
        'description' => 'Edit Status shipped-from-china-warehouse',
      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.received-in-BD-warehouse',
        'description' => 'Edit Status received-in-BD-warehouse',
      ]),
    ]);

    $settings = Permission::create([
      'type' => Setting::TYPE_ADMIN,
      'name' => 'admin.settings',
      'description' => 'Settings Permissions',
    ]);

    $accounts = Permission::create([
      'type' => Setting::TYPE_ADMIN,
      'name' => 'admin.accounts',
      'description' => 'Accounts Permissions',
    ]);

    $status = Permission::create([
      'type' => Order::TYPE_ADMIN,
      'name' => 'admin.status',
      'description' => 'View All Status Permissions',
    ]);
    $status->children()->saveMany([
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.waiting-for-payment',
        'description' => 'View Waiting For Payment',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.processing',
        'description' => 'View Processing',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.on-hold',
        'description' => 'View On-hold',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.partial-paid',
        'description' => 'View Partial-paid',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.purchased',
        'description' => 'View Purchased',

      ]),

      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.re-order',
        'description' => 'View Re-order',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.refund',
        'description' => 'View Refund',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.shipped-from-suppliers',
        'description' => 'View Shipped From Suppliers',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.received-in-chinawarehouse',
        'description' => 'View Received in China Warehouse',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.shipped-from-chinawarehouse',
        'description' => 'View Shipped From China Warehouse',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.received-in-bdwarehouse',
        'description' => 'View Received in BDwarehouse',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.delivery-after-holiday',
        'description' => 'View Delivery After Holiday',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.delivered',
        'description' => 'View Deliverd',

      ]),
    ]);

    $this->enableForeignKeys();
  }
}
