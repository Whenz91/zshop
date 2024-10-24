<?php

use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\HomePage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/products/{product}', ProductDetailPage::class)->name('product');
Route::get('/cart', CartPage::class)->name('cart');