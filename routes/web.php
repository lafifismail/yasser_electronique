<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storefront\HomeController;
use App\Http\Controllers\Storefront\CatalogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Storefront ---
Route::get('/', [HomeController::class, 'index'])->name('storefront.home');
Route::get('/categorie/{slug}', [CatalogController::class, 'showCategory'])->name('storefront.category');
Route::get('/produit/{slug}', [CatalogController::class, 'showProduct'])->name('storefront.product');
