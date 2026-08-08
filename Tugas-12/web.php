<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes - E-Commerce
|--------------------------------------------------------------------------
| TUGAS 2: Route dasar untuk website e-commerce
| TUGAS 3: Controller dasar untuk Mengelola Produk & Mengelola Halaman
*/

// ---------- HALAMAN (PageController) ----------
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// ---------- PRODUK (ProductController) ----------
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Keranjang belanja
Route::get('/cart', [OrderController::class, 'showCart'])->name('cart.index');
Route::post('/cart/add/{id}', [OrderController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [OrderController::class, 'removeFromCart'])->name('cart.remove');

// Checkout
Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');
