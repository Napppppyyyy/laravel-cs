<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController as AuthController;

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

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getProducts']);
    Route::get('/{id}', [ProductController::class, 'show']); // Add this if you want single product view
});

Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'addProduct']);
        Route::put('/{id}', [ProductController::class, 'editProduct']);
        Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'getUsers']);
        Route::post('/', [UserController::class, 'addUser']);
        Route::put('/{id}', [UserController::class, 'editUser']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthController::class, 'login']); // You'll need to create AuthController
Route::post('/register', [AuthController::class, 'register']);