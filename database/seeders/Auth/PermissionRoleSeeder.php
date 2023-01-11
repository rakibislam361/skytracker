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
      'description' => 'All Order Permissions',
    ]);
    $orders->children()->saveMany([
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.order_rmb.edit',
        'description' => 'Edit Order Rmb',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.localdelivery.edit',
        'description' => 'Edit Local Delivery',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.purchase.edit',
        'description' => 'Actual Cost(Purchase Cost)',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.status.edit',
        'description' => 'Edit Status',

      ]),

      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.carton.edit',
        'description' => 'Edit Carton Information',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.rate.edit',
        'description' => 'Edit Rate',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.order.cbm.edit',
        'description' => 'Edit Cbm',

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
      'description' => 'Status Permissions',
    ]);
    $status->children()->saveMany([
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.waiting-for-payment',
        'description' => 'Waiting For Payment',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.processing',
        'description' => 'Processing',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.on-hold',
        'description' => 'On-hold',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.partial-paid',
        'description' => 'Partial-paid',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.purchased',
        'description' => 'Purchased',

      ]),

      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.re-order',
        'description' => 'Re-order',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.refund',
        'description' => 'Refund',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.shipped-from-suppliers',
        'description' => 'Shipped From Suppliers',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.received-in-chinawarehouse',
        'description' => 'Received in China Warehouse',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.shipped-from-chinawarehouse',
        'description' => 'Shipped From China Warehouse',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.received-in-bdwarehouse',
        'description' => 'Received in BDwarehouse',

      ]),
      new Permission([
        'type' => Order::TYPE_ADMIN,
        'name' => 'admin.status.delivered',
        'description' => 'Deliverd',

      ]),
    ]);

    $this->enableForeignKeys();
  }
}
