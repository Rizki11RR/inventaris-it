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
use App\Http\Controllers\AHPController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MonitoringController;





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

// Grouping Dashboard berdasarkan Role
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
    
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
        Route::get('/staff/assets', [AssetController::class, 'index'])->name('staff.assets.index');
        Route::post('/staff/assets', [AssetController::class, 'store'])->name('staff.assets.store');
        Route::delete('/staff/assets/{asset}', [AssetController::class, 'destroy'])->name('staff.assets.destroy');
        Route::put('/staff/assets/{asset}', [AssetController::class, 'update'])->name('staff.assets.update');
        Route::get('/staff/assessments', [AssessmentController::class, 'index'])->name('staff.assessments.index');
        Route::get('/staff/assessments/calculate/{asset}', [AssessmentController::class, 'create'])->name('staff.assessments.create');
        Route::post('/staff/assessments/store', [AssessmentController::class, 'store'])->name('staff.assessments.store');
        Route::get('/staff/assessments/history', [AssessmentController::class, 'history'])->name('staff.assessments.history');
        Route::post('/staff/maintenance/store', [MaintenanceController::class, 'store'])->name('staff.maintenance.store');
        Route::get('/staff/maintenance/history', [MaintenanceController::class, 'index'])->name('staff.maintenance.history');
    });

    Route::middleware(['role:manajemen'])->group(function () {
        Route::get('/manajemen/dashboard', [ManajemenController::class, 'index'])->name('manajemen.dashboard');
        Route::get('/laporan-rekomendasi', [ManajemenController::class, 'laporan'])->name('manajemen.laporan');
        Route::get('/laporan-rekomendasi/cetak', [ManajemenController::class, 'cetak'])->name('manajemen.cetak');
    });
});

// Admin Area (Master Data & AHP Logic)
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // User Management
    Route::prefix('admin')->group(function () {
        Route::get('/users', [AdminController::class, 'userIndex'])->name('admin.users.index');
        Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
        Route::delete('/assessments/{id}/reset', [AssessmentController::class, 'reset'])->name('admin.assessments.reset');
        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring');
        Route::delete('/monitoring/{id}/reset', [MonitoringController::class, 'reset'])->name('admin.monitoring.reset');
    }); 

    // Master Data
    Route::resource('categories', CategoryController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('statuses', StatusController::class);
    
    // AHP - Kriteria & Sub-Kriteria
    Route::resource('criterias', CriteriaController::class);
    Route::post('/criterias/sub', [CriteriaController::class, 'storeSub'])->name('criterias.storeSub');
    Route::delete('/criterias/sub/{id}', [CriteriaController::class, 'destroySub'])->name('criterias.destroySub');
    
    // AHP - Matriks Perbandingan & Kalkulasi
    Route::get('/ahp/comparisons', [AHPController::class, 'index'])->name('ahp.comparisons');
    Route::post('/ahp/comparisons', [AHPController::class, 'store'])->name('ahp.store_comparisons');
    Route::get('/ahp/results', [AHPController::class, 'showResults'])->name('ahp.results');
});

require __DIR__.'/auth.php';