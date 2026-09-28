<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'home'])->name('home');

Route::get('geschaeft/', [ShopController::class, 'shop'])->name('shop');
Route::get('product-category/{slug}/', [ShopController::class, 'category'])->name('category');
Route::get('product/{slug}/', [ShopController::class, 'product'])->name('product');
Route::get('product/{slug}/quickview', [ShopController::class, 'quickview'])->name('product.quickview');

Route::get('cart/', [CartController::class, 'index'])->name('cart');
Route::post('cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('kasse/', [CheckoutController::class, 'index'])->name('checkout');
Route::post('kasse/', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('commande-confirmee/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('login/', [AuthController::class, 'showLogin'])->name('login');
Route::post('login/', [AuthController::class, 'login']);
Route::get('register/', [AuthController::class, 'showRegister'])->name('register');
Route::post('register/', [AuthController::class, 'register']);
Route::post('logout/', [AuthController::class, 'logout'])->name('logout');
Route::get('my-account/', [AuthController::class, 'account'])->name('account');

Route::get('wishlist/', [FavoriteController::class, 'index'])->name('wishlist');
Route::get('wishlist/render', [FavoriteController::class, 'renderGuest'])->name('wishlist.render');
Route::post('wishlist/toggle/{product}', [FavoriteController::class, 'toggle'])->name('wishlist.toggle');

Route::get('tracking-order/', [OrderTrackingController::class, 'show'])->name('tracking-order');
Route::get('help-center/', fn () => view('pages.help-center'))->name('help-center');
Route::get('kontaktieren-sie-uns/', [ContactController::class, 'show'])->name('contact');
Route::post('kontaktieren-sie-uns/', [ContactController::class, 'store'])->name('contact.store');

$staticPages = [
    'agb', 'rueckgabe-und-erstattung', 'lieferung-und-versand',
    'datenschutzerklaerung-2', 'impressum', 'zahlungsmethoden', 'ueber-uns',
];

Route::get('{slug}/', [PageController::class, 'show'])
    ->where('slug', implode('|', $staticPages))
    ->name('page');
