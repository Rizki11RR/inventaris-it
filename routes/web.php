<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CriteriaController;




Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('categories', CategoryController::class);

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
    
    Route::middleware(['auth', 'role:staff'])->group(function () {
        Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
    });

    Route::middleware(['auth', 'role:manajemen'])->group(function () {
        Route::get('/manajemen/dashboard', [ManajemenController::class, 'index'])->name('manajemen.dashboard');
    });

});


// Admin Route
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'userIndex'])->name('admin.users.index');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('statuses', StatusController::class);
});

Route::resource('criterias', CriteriaController::class);
// Rute tambahan untuk Sub-Kriteria
Route::post('/criterias/sub', [CriteriaController::class, 'storeSub'])->name('criterias.storeSub');
Route::delete('/criterias/sub/{id}', [CriteriaController::class, 'destroySub'])->name('criterias.destroySub');
require __DIR__.'/auth.php';
