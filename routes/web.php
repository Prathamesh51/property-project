<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register-form', [AuthController::class, 'userRegisterForm']);
Route::post('/register', [AuthController::class, 'userRegister']);


Route::prefix('login')->group(function () {
    Route::get('', [AuthController::class, 'userLoginForm'])->name('login');
    Route::post('', [AuthController::class, 'userLogin']);

    Route::get('/admin', [AuthController::class, 'adminLoginForm']);
    Route::post('/admin', [AuthController::class, 'adminLogin']);
});

Route::prefix('property')->group(function () {
    Route::middleware(['auth', 'userAuth:user,admin'])->group(function () {
        Route::get('/', [PropertyController::class, 'index']);
        Route::get('/filter', [PropertyController::class, 'filterProperties']);
    });
    Route::middleware(['auth','userAuth:admin'])->group(function() {
        Route::get('/create', [PropertyController::class, 'create']);
        Route::post('/store', [PropertyController::class, 'store']);
        Route::get('/{propetryId}/edit', [PropertyController::class, 'edit']);
        Route::put('/{propetryId}', [PropertyController::class, 'update']);
        Route::delete('/{propetryId}', [PropertyController::class, 'destroy']);
        Route::get('/user-requests', [AuthController::class, 'userRequests']);
        Route::post('/approve-request/{userId}', [AuthController::class, 'approveUser']);
        // Route::resource('', PropertyController::class)->names('property');
    });
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/message', [PropertyController::class, 'frontPage']);

Route::post('/test', [PropertyController::class, 'test']);