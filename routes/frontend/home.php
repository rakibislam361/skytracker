<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\TrackingController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */


Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

Route::get('about', [AboutController::class, 'index'])
    ->name('pages.about')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_About'), route('frontend.pages.about'));
    });

// Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
//     Route::resources([
//         'contact' => ContactController::class,
//     ]);
// });
Route::get('contact', [ContactController::class, 'index'])
    ->name('pages.contact')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_contact'), route('frontend.pages.contact'));
    });
// Route::resource('contact', ContactController::class);
Route::post('contact', [ContactController::class, 'contact']);
// Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
// Route::post('/contact', [ContactController::class, 'storeContact'])->name('contact.store');


Route::get('track', [TrackingController::class, 'Track'])
    ->name('pages.tracking')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_track'), route('frontend.pages.tracking'));
    });
