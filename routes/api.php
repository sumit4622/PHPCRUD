<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [UsersController::class, 'login']);
    Route::post('registration', [UsersController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiresource('products', ProductController::class);

        Route::resource('AdminDashboard', AdminController::class);
        Route::delete('AdminDashboard/{userId}/item/{itemId}', [AdminController::class, 'delete_item']);
        Route::get('Useredit/{userId}/', [AdminController::class, 'get_username']);
        Route::patch('Userupdate/{userId}/', [AdminController::class, 'edit_user_profile']);
        
        Route::post('logout', [UsersController::class, 'logout']);
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
