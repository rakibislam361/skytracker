<?php

use App\Domains\Contact\Http\Controllers\ContactController;
use App\Domains\Page\Http\Controllers\PageController;
use App\Domains\Products\Http\Controllers\BrandController;
use App\Domains\Products\Http\Controllers\CategoryController;
use App\Domains\Products\Http\Controllers\ProductController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
  Route::resources([
    'brand' => BrandController::class,
    'category' => CategoryController::class,
    'inhouse' => ProductController::class,
  ]);
});

Route::resource('page', PageController::class);

Route::group(['prefix' => 'messaging', 'as' => 'messaging.'], function () {
  Route::resources([
    'contact' => ContactController::class,
  ]);
});
