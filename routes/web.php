
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductsController::class, 'index']);
// Route::get('/categories', [CategoryController::class, 'index']);
Route::resource('categories', CategoryController::class);


// Route::middleware(['permission:manage products'])->group(function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create')->middleware(middleware: ['auth', 'role:admin']);
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
// })->middleware(['auth', 'role:admin']);

// Route::middleware(['permission:manage reviews'])->group(function () {
    Route::get('/reviews', [ReviewController::class, 'reviews'])->name('reviews');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
// });
Route::get('/categories/{catid}/products', [ProductsController::class, 'index']);



Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
