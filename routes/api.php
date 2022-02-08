<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);
Route::prefix('categories')->group(function () {
    Route::get('/get', [CategoryController::class, 'getCategories']);
    Route::get('/{category}', [CategoryController::class, 'category'])->name('category');
    Route::get('/{category}/getProducts', [CategoryController::class, 'getProducts']);
});

Route::prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'index'])->name('basket');
    Route::get('/getProductsQuantity', [BasketController::class, 'getProductsQuantity']);
    Route::post('/createOrder', [BasketController::class, 'createOrder'])->name('createOrder');
    Route::prefix('product')->group(function () {
        Route::post('/add', [BasketController::class, 'add'])->name('addProduct');
        Route::post('/remove', [BasketController::class, 'remove'])->name('removeProduct');
    });
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/enterAsUser/{userId}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
//    Route::get('/users', [AdminController::class, 'allUsers'])->name('allUsers');
    Route::get('/categories', [AdminController::class, 'allCategories'])->name('allCategories');
//    Route::get('/category/{id}', [AdminController::class, 'editCategory'])->name('editCategory');
//    Route::post('/category', [AdminController::class, 'updateCategory'])->name('updateCategory');
//    Route::post('/storeCategory', [AdminController::class, 'storeCategory'])->name('storeCategory');
//    Route::view('/addCategory', 'admin.categories.add')->name('addCategory');
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');
//    Route::post('/importCategories', [AdminController::class, 'importCategories'])->name('importCategories');
//    Route::get('/delCategory/{id}', [AdminController::class, 'delCategory'])->name('delCategory');

//    Route::get('/products', [ProductController::class, 'products'])->name('allProducts');
//    Route::post('/product', [ProductController::class, 'updateProduct'])->name('updateProduct');
//    Route::get('/product/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
//    Route::get('/addProducts', [ProductController::class, 'addProduct'])->name('addProducts');
//    Route::post('/storeProduct', [ProductController::class, 'storeProduct'])->name('storeProduct');
//    Route::get('/delProduct/{id}', [ProductController::class, 'delProduct'])->name('delProduct');
//    Route::post('/exportProducts', [ProductController::class, 'exportProducts'])->name('exportProducts');
//    Route::post('/importProducts', [ProductController::class, 'importProducts'])->name('importProducts');


        Route::get('/products', function () {
        return 'Админка: продукты';
    })->name('adminProducts');
});
