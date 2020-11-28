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
});
/* AQUI ESTA EL WELCOME
Cambialo por un controlador propio tipo
//Route::get('/admin/product/list', [ProductsController::class, 'index'])->middleware(['auth'])->name('productList');
ó crea una un componente ProductsShop o similar que solo lo llames en cualquier vista y te de una lista de productos
ó pasale un parametro que es lo mas facil antes del return view, algo como, $products = \App\Models\Product;
//Route::get('/', function () {
//    $products = \App\Models\Product::all();
//    return view('welcome', ['products' => $products]);
//});
*/

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');


use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');

use App\Http\Controllers\ProductsController;
//auth admin view
Route::get('/admin/product/create', [ProductsController::class, 'create'])->middleware(['auth'])->name('productCreate');
Route::post('/admin/product/create', [ProductsController::class, 'createAjax'])->middleware(['auth']);
Route::get('/admin/product/list', [ProductsController::class, 'index'])->middleware(['auth'])->name('productList');
Route::get('/admin/product/edit/{id}', [ProductsController::class, 'edit'])->middleware(['auth'])->name('productEdit');
Route::post('/admin/product/edit/{id}', [ProductsController::class, 'updateAjax'])->middleware(['auth']);
Route::get('/admin/product/del/{id}', [ProductsController::class, 'deleteAjax'])->middleware(['auth'])->name('productDel');



//guest view
Route::get('/product', [ProductsController::class, 'show'])->name('show');

Route::fallback(function () {
    return redirect("/");
});

