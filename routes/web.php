<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use Symfony\Component\HttpFoundation\Request;

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

// Route::get('register', [UsersController::class, 'index']);


Route::get('/', [UsersController::class, 'index'])->name('authentication.login');
Route::get('registertion', [UsersController::class, 'show'])->name('authentication.register');

Route::post('login/', [UsersController::class, 'login'])->name('products.dashboard');
Route::post('registertion', [UsersController::class, 'store'] ) -> name('authentication.login1');

Route::post('/logout', [UsersController::class, 'logout'])->name('user.logout');


Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

Route::middleware(['admin'])->group(function () {
    Route::resource('admin-dashboard', AdminController::class);
    
});




