<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductsController::class, 'index']);
// Route::get('/categories', [CategoryController::class, 'index']);
Route::resource('categories', CategoryController::class);


// Route::middleware(['permission:manage products'])->group(function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index')->middleware('auth');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create')->middleware(middleware: ['auth', 'role:admin']);
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store')->middleware(middleware: ['auth', 'role:admin']);
    Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show')->middleware(middleware: ['auth', 'role:admin']);
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy')->middleware(middleware: ['auth', 'role:admin']);
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit')->middleware(middleware: ['auth', 'role:admin']);
    Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update')->middleware(middleware: ['auth', 'role:admin']);
// })->middleware(['auth', 'role:admin']);

// Route::middleware(['permission:manage reviews'])->group(function () {
    Route::get('/reviews', [ReviewController::class, 'reviews'])->name('reviews.index')->middleware('auth');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
// });
Route::get('/categories/{catid}/products', [ProductsController::class, 'index'])->name('categories.products')->middleware('auth');



Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/cart',[CartController::class,'index'])->name('cart.index')->middleware('auth');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.show')->middleware('auth');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process')->middleware('auth');

Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index')->middleware('auth');
Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create')->middleware('auth');

// Orders Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrdersController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [OrdersController::class, 'invoice'])->name('orders.invoice');
    Route::get('/orders/{order}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrdersController::class, 'destroy'])->name('orders.destroy');
});
Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store')->middleware('auth');
Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit')->middleware('auth');
Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update')->middleware('auth');
Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy')->middleware('auth');
Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
Route::get('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');

// Shipping Routes
Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store')->middleware('auth');
Route::put('/shipping/{shipping}', [ShippingController::class, 'update'])->name('shipping.update')->middleware('auth');

// Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
Route::get('/about', function () {
    return view('about');
});
