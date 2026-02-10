<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;

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


Route::get('login', [UsersController::class, 'index'])->name('authentication.register');
Route::get('register', [UsersController::class, 'create'])->name('authentication.login');

// Route::post('regist')
// Route::post('login', UsersController::class);

// Route::resource('products', ProductController::class)-> middleware('auth');

// Route::post('login', [UsersController::class, 'login']);

// Route::get('alubacha/',function(){
//     return view('temp');
// });
