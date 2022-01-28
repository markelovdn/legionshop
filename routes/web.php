<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
})->name('main');

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth')->name('profile');
    Route::post('/profile/update', [HomeController::class, 'profileUpdate'])->name('profileUpdate');
});

Route::prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'index'])->name('basket');
    Route::post('/createOrder', [BasketController::class, 'createOrder'])->name('createOrder');
    Route::prefix('product')->group(function () {
        Route::post('/add', [BasketController::class, 'add'])->name('addProduct');
        Route::post('/remove', [BasketController::class, 'remove'])->name('removeProduct');
    });
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders');


// Route::any('/{any}', function () {
//     return redirect(route('main'));
// })->where('any', '.*');

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/categories/{category}', [CategoryController::class, 'category'])->name('category');
Route::get('/categories/{category}/getProducts', [CategoryController::class, 'getProducts']);

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/enterAsUser/{userId}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    Route::get('/users', [AdminController::class, 'allUsers'])->name('allUsers');
    Route::get('/categories', [AdminController::class, 'allCategories'])->name('allCategories');
    Route::get('/category/{id}', [AdminController::class, 'editCategory'])->name('editCategory');
    Route::post('/category', [AdminController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/storeCategory', [AdminController::class, 'storeCategory'])->name('storeCategory');
    Route::view('/addCategory', 'admin.categories.add')->name('addCategory');
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');
    Route::get('/delCategory/{id}', [AdminController::class, 'delCategory'])->name('delCategory');

    Route::get('/products', [ProductController::class, 'products'])->name('allProducts');
    Route::post('/product', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/product/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
    Route::get('/addProducts', [ProductController::class, 'addProduct'])->name('addProducts');
    Route::post('/storeProduct', [ProductController::class, 'storeProduct'])->name('storeProduct');
    Route::get('/delProduct/{id}', [ProductController::class, 'delProduct'])->name('delProduct');




});
