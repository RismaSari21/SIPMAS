<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Masyarakat\ComplaintController as MasyarakatComplaintController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/wilayah/provinces', [WilayahController::class, 'provinces'])->name('wilayah.provinces');
    Route::get('/wilayah/regencies/{province}', [WilayahController::class, 'regencies'])->name('wilayah.regencies');
    Route::get('/wilayah/districts/{regency}', [WilayahController::class, 'districts'])->name('wilayah.districts');
    Route::get('/wilayah/villages/{district}', [WilayahController::class, 'villages'])->name('wilayah.villages');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('users', UserController::class);
        Route::resource('complaints', AdminComplaintController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::resource('responses', ResponseController::class)->only(['store', 'destroy']);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
    });

    Route::prefix('masyarakat')->name('masyarakat.')->middleware('role:masyarakat')->group(function () {
        Route::get('/dashboard', [MasyarakatDashboardController::class, 'index'])->name('dashboard');
        Route::resource('complaints', MasyarakatComplaintController::class);
    });
});

require __DIR__.'/auth.php';
