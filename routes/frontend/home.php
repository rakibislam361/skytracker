<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\TrackingController;
use App\Http\Controllers\Frontend\d2dController;
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
    Route::get('notice/details/{id}', [HomeController::class, 'noticedetails']);
    Route::get('info/details/{id}', [HomeController::class, 'infodetails']);
    Route::get('notice/all', [HomeController::class, 'noticeall']);
    Route::get('page/{slug}', [HomeController::class, 'pageshow']);
    Route::get('info/all', [HomeController::class, 'infoall']);
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


Route::get('contact', [ContactController::class, 'index'])
    ->name('pages.contact')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_contact'), route('frontend.pages.contact'));
    });
Route::post('contact', [ContactController::class, 'store']);



Route::get('tracking', [TrackingController::class, 'Tracking'])
    ->name('pages.tracking')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_track'), route('frontend.pages.tracking'));
    });
Route::get('track', [TrackingController::class, 'Track'])
    ->name('pages.shippingInformationModal')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_track'), route('frontend.pages.shippingInformationModal'));
    });

Route::get('d2d', [d2dController::class, 'd2d'])
    ->name('pages.d2d')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('_d2d'), route('frontend.pages.d2d'));
    });
Route::get('/info/{shipped_from}', [HomeController::class, 'index']);
