<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [PageController::class, 'home'])->name('homepage');

Route::resource('/page', PageController::class)->only(['show']);

Route::resource('/product', ProductController::class);
Route::post('product_enquiry/{product}', [ProductController::class, 'enquiry'])->name('product_enquiry');
Route::post('product_image', [ProductController::class, 'productImages'])->name('product_multiple_images');