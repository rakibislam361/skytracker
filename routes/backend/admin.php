<?php

use App\Domains\Contacts\Http\Controllers\ContactController;
use App\Domains\Page\Http\Controllers\PageController;
use App\Domains\Products\Http\Controllers\BrandController;
use App\Domains\Products\Http\Controllers\WarehouseController;
use App\Domains\Products\Http\Controllers\ProductController;
use App\Domains\Products\Http\Controllers\StatusController;
use App\Domains\Products\Http\Controllers\ShippingController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;


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
