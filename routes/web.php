<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
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
Route::get('/app', function () {
    dd(resolve('request'));
});

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoicesController::class);
Route::resource('sections', SectionController::class);
Route::resource('products', ProductController::class);

Route::get('section/{id}', [ProductController::class,'getProducts']); //ajax 
Route::get('InvoicesDetails/{id}', [InvoiceDetailController::class,'index']);

Route::get('/{page}', [AdminController::class,'index']) -> middleware('auth');


