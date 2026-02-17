<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storefront\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Coming Soon pages
Route::get('/catalog', function () {
    return view('pages.coming-soon', ['pageTitle' => 'Catalogue']);
})->name('catalog');

Route::get('/cart', function () {
    return view('pages.coming-soon', ['pageTitle' => 'Panier']);
})->name('cart');
