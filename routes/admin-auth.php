<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Admin\Auth\RegisteredadminController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredadminController::class, 'create'])
        ->name('admin.auth.register');
    Route::post('register', [RegisteredadminController::class, 'store']);


    


    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::prefix('admin')->middleware('auth::admin')->group(function () {
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
