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
    Route::get('/categories/export', [CategoryController::class, 'export']);

    // Items
    Route::get('items/{item}/lendings', [ItemController::class, 'lendingDetails'])->name('items.lending_details');
    Route::resource('items', ItemController::class)->except(['show', 'destroy']);
    Route::get('/items/export', [ItemController::class, 'export']);

    // Users
    Route::resource('users', UserController::class)->except(['show']);

    //Export
    Route::get('/users/export', [UserController::class, 'export']);
});

// ==========================================
// AREA STAFF & HEAD STAFF (Bisa diakses keduanya)
// ==========================================
Route::middleware(['auth', 'role:staff,headstaff'])->prefix('staff')->name('staff.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('dashboard');

    // Route Peminjaman (Urutan Export harus di atas rute yang pakai {id})
    Route::get('/borrows/export', [\App\Http\Controllers\Staff\BorrowController::class, 'export'])->name('borrows.export');

    Route::get('/borrows', [\App\Http\Controllers\Staff\BorrowController::class, 'index'])->name('borrows.index');
    Route::get('/borrows/create', [\App\Http\Controllers\Staff\BorrowController::class, 'create'])->name('borrows.create');
    Route::post('/borrows', [\App\Http\Controllers\Staff\BorrowController::class, 'store'])->name('borrows.store');
    Route::delete('/borrows/{id}', [\App\Http\Controllers\Staff\BorrowController::class, 'destroy'])->name('borrows.destroy');
    Route::post('/borrows/{id}/return', [\App\Http\Controllers\Staff\BorrowController::class, 'returnItem'])->name('borrows.return');

});

// ==========================================
// AREA KHUSUS HEAD STAFF (Hanya Head Staff)
// ==========================================
Route::middleware(['auth', 'role:headstaff'])->prefix('staff')->name('staff.')->group(function () {

    // Route Manajemen Akun Staff (Hanya boleh diakses si Bos/Headstaff)
    Route::get('/users/export', [\App\Http\Controllers\Staff\UserController::class, 'export'])->name('users.export');
    Route::resource('users', \App\Http\Controllers\Staff\UserController::class)->except(['show']);

});
