<?php

use App\Domains\Contacts\Http\Controllers\ContactController;
use App\Domains\Page\Http\Controllers\PageController;
use App\Domains\Products\Http\Controllers\BrandController;
use App\Domains\Products\Http\Controllers\WarehouseController;
use App\Domains\Products\Http\Controllers\ProductController;
use App\Domains\Products\Http\Controllers\StatusController;
use App\Domains\Products\Http\Controllers\ShippingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\Content\SettingController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;


// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('search', [DashboardController::class, 'search'])->name('order.search');


Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
  Route::resources([
    'brand' => BrandController::class,
    'warehouse' => WarehouseController::class,
    'inhouse' => ProductController::class,
    'status' => StatusController::class,
    // 'updatestatus' => UpdateStatusController::class,
    'shipping' => ShippingController::class,
    'product' => ProductController::class,
  ]);
});


Route::resource('page', PageController::class);

Route::group(['prefix' => 'messaging', 'as' => 'messaging.'], function () {
  Route::resources([
    'contact' => ContactController::class,
  ]);
});

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
  Route::get('price', [SettingController::class, 'price'])->name('price');
  Route::post('airShippingStore', [SettingController::class, 'airShippingStore'])->name('airShippingStore');
  Route::post('logo-store', [SettingController::class, 'logoStore'])->name('logoStore');
  Route::post('social-store', [SettingController::class, 'socialStore'])->name('socialStore');
  Route::get('general', [SettingController::class, 'general'])->name('general');
  Route::get('cache-control', [SettingController::class, 'cacheControl'])->name('cache.control');
  Route::post('cache-control-store', [SettingController::class, 'cacheClear'])->name('cache.control.store');
  Route::post('short-message', [SettingController::class, 'shortMessageStore'])->name('short.message.store');

  Route::get('top-notice', [SettingController::class, 'topNoticeCreate'])->name('topNotice.create');
  Route::post('top-notice', [SettingController::class, 'topNoticeStore'])->name('topNotice.store');
});

Route::resource('order', OrderController::class);
Route::post('order-update', [OrderController::class, "orderUpdate"])->name('order-update');
Route::get('order/local', [OrderController::class, 'walletOrders'])->name('order.local');
Route::get('order/local/{id}', [OrderController::class, 'walletDetails'])->name('order.local.details');
