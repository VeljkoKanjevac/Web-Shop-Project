<?php

use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminCheckMiddleware;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

//User routes
Route::middleware('auth')->group(function () {

});

//Admin routes
Route::middleware(['auth', AdminCheckMiddleware::class])->prefix('/admin')->group(function () {

    Route::view('/', 'admin.welcome')->name('admin.home');

    Route::controller(AdminProductsController::class)->prefix('/product')->name('product.')->group(function () {

        Route::get('/all', 'allProducts')->name('all');
    });

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
