<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storefront\HomeController;
use App\Http\Controllers\Storefront\CatalogController;
use App\Http\Controllers\Storefront\PageController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Storefront\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Storefront ---
Route::get('/', [HomeController::class, 'index'])->name('storefront.home');
Route::get('/categorie/{slug}', [CatalogController::class, 'showCategory'])->name('storefront.category');
Route::get('/produit/{slug}', [CatalogController::class, 'showProduct'])->name('storefront.product');
Route::get('/ricerca', [CatalogController::class, 'search'])->name('storefront.search');

// --- Carrello ---
Route::post('/carrello/aggiungi', [CartController::class, 'add'])->name('storefront.cart.add');
Route::get('/carrello', [CartController::class, 'index'])->name('storefront.cart.index');
Route::patch('/carrello/aggiorna', [CartController::class, 'update'])->name('storefront.cart.update');
Route::delete('/carrello/rimuovi', [CartController::class, 'remove'])->name('storefront.cart.remove');
Route::post('/carrello/sconto', [CartController::class, 'applyDiscount'])->name('storefront.cart.discount');

// --- Checkout (canonical) ---
Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('storefront.checkout');
Route::post('/checkout', [CheckoutController::class, 'place'])->name('storefront.checkout.place');
Route::get('/checkout/conferma/{order}', [CheckoutController::class, 'confirmation'])->name('storefront.checkout.confirmation');

// --- Cassa (alias italiani — Plan Directeur Étape 6) ---
Route::get('/cassa', [CheckoutController::class, 'showForm'])->name('storefront.checkout.index');
Route::post('/cassa/process', [CheckoutController::class, 'place'])->name('storefront.checkout.process');

// --- Pages statiques / institutionnelles ---
Route::get('/chi-siamo', [PageController::class, 'about'])->name('storefront.about');
Route::get('/contattaci', [PageController::class, 'contact'])->name('storefront.contact');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('storefront.privacy');
Route::get('/politica-di-rimborso', [PageController::class, 'refund'])->name('storefront.refund');
