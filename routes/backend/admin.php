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
Route::get('search', [DashboardController::class, 'search'])->name('search');


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

Route::get('order/restore/{order}', [OrderController::class, 'restore'])->name('order.restore');
Route::get('makeAsPayment/{order}', [OrderController::class, 'makeAsPayment'])->name('order.makeAsPayment');
Route::get('order/wallet', [OrderController::class, 'walletOrders'])->name('order.wallet');
Route::get('order/wallet/{id}', [OrderController::class, 'walletDetails'])->name('order.wallet.details');

Route::post('order/operation/{order}', [OrderController::class, 'bkashOperation'])->name('order.bkash.operation');
Route::post('order/refund/{order}', [OrderController::class, 'refundPayment'])->name('order.refund');

Route::get('order-item/edit/{id}', [OrderController::class, 'show_details'])->name('order.item.edit');
Route::post('order/change/status/{id}', [OrderController::class, 'changeStatus'])->name('order.change.status');
Route::post('order/coupon-update/{id}', [OrderController::class, 'updateCoupon'])->name('order.coupon.update');
Route::post('order/deposit-update/{id}', [OrderController::class, 'depositCoupon'])->name('order.deposit.update');
Route::resource('order', OrderController::class);
