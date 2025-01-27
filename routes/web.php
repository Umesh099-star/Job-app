<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Auth\RegisteredadminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/home',[HomeController::class.'index'])
// // ->middleware('auth','web')
//     ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// require __DIR__.'/admin-auth.php';
// User Routes


// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/register', [RegisteredadminController::class, 'showRegisterForm'])->name('admin.auth.register');
    Route::post('/register', [RegisteredadminController::class, 'store']);
    // ->middleware(['auth','admin']);
    // Admin dashboard route
   
        // Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        //     Route::get('/dashboard', [HomeController::class, 'index'])
        //         ->name('admin.dashboard'); // Ensure this name matches the redirection
        // });
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard'); // Admin dashboard view
    // })->middleware(['auth','admin'])->name('admin.dashboard');
       
    
});

// route::get('admin/dashboard',[HomeController::class,'index'])->
// middleware(['auth','admin']);


// Admin Dashboard Route
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('admin.dashboard'); // Ensure this name matches the redirection
});