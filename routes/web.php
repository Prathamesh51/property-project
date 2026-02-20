<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoleController;
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
        Route::get('/users/list', [AuthController::class, 'usersList']);
    });
});

Route::prefix('roles')->group(function() {
    Route::middleware(['auth','userAuth:admin,user'])->group(function() {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:View Role');
        Route::get('/{roleId}/edit', [RoleController::class, 'edit'])->middleware('permission:Edit Role');
        Route::put('/{roleId}', [RoleController::class, 'update'])->middleware('permission:Edit Role');
        Route::get('/create', [RoleController::class, 'create'])->middleware('permission:Create Role');
        Route::post('/assign/{userId}', [RoleController::class, 'assignRole'])->middleware('permission:Edit Role');
    });
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/message', [PropertyController::class, 'frontPage']);

Route::post('/test', [PropertyController::class, 'test']);