<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "Redirect Working";
});


Route::prefix('login')->group(function () {
    Route::get('', [AuthController::class, 'userLoginForm']);
    Route::post('', [AuthController::class, 'userLogin']);

    Route::get('/admin', [AuthController::class, 'adminLoginForm']);
    Route::post('/admin', [AuthController::class, 'adminLogin']);
});


    // Route::middleware(['auth', 'role:admin'])->group(function () {
    //     Route::resource('/admin/properties', PropertyController::class);
    //     });
    Route::get('/admin/dashboard', [PropertyController::class, 'adminDashboard'])->middleware('userAuth');

    Route::get('/dashboard', [PropertyController::class, 'userDashboard']);

    Route::get('/message', [PropertyController::class, 'frontPage']);

Route::post('/test', [PropertyController::class, 'test']);