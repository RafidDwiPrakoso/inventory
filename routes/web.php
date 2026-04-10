<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/403', function () {
    return view('errors.403');
})->name('errors.403');


// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kategori
    Route::resource('categories', CategoryController::class)->except(['show', 'destroy']);

    // Items
    Route::get('items/{item}/lendings', [ItemController::class, 'lendingDetails'])->name('items.lending_details');
    Route::resource('items', ItemController::class)->except(['show', 'destroy']);

    // Users
    Route::resource('users', UserController::class)->except(['show']);

    //Export
    Route::get('/users/export', [UserController::class, 'export']);
});

// STAFF
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('dashboard');
    });
