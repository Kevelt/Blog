<?php

use Illuminate\Support\Facades\Route;



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
    $products = \App\Models\Product::all();
    return view('welcome', ['products' => $products]);
})->name('welcome');;


Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');


use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');

use App\Http\Controllers\ProductsController;
//auth admin view product
Route::get('/admin/product/create', [ProductsController::class, 'create'])->middleware(['auth'])->name('productCreate');
Route::post('/admin/product/create', [ProductsController::class, 'createAjax'])->middleware(['auth']);
Route::get('/admin/product/list', [ProductsController::class, 'index'])->middleware(['auth'])->name('productList');
Route::get('/admin/product/edit/{id}', [ProductsController::class, 'edit'])->middleware(['auth'])->name('productEdit');
Route::post('/admin/product/edit/{id}', [ProductsController::class, 'updateAjax'])->middleware(['auth']);
Route::get('/admin/product/del/{id}', [ProductsController::class, 'deleteAjax'])->middleware(['auth'])->name('productDel');

use App\Http\Controllers\CategoryController;
// Auth Admin View Category
Route::get('/admin/category/create', [CategoryController::class, 'create'])->middleware(['auth'])->name('categoryCreate');
Route::post('/admin/category/create', [CategoryController::class, 'createAjax'])->middleware(['auth']);
Route::get('/admin/category/list', [CategoryController::class, 'index'])->middleware(['auth'])->name('categoryList');



//guest view
Route::get('/product', [ProductsController::class, 'show'])->name('show');

Route::fallback(function () {
    return redirect("/");
});

