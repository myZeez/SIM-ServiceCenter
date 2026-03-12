<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\DiagnosisChat;
use App\Livewire\ServiceStatus;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// ========================================
// PUBLIC ROUTES (TANPA LOGIN)
// ========================================
Route::get('/diagnosis', DiagnosisChat::class)->name('diagnosis');
Route::get('/cek-status', ServiceStatus::class)->name('service-status');

// ========================================
// ADMIN OPERASIONAL ROUTES
// ========================================
// Hanya role 'admin' yang bisa mengakses
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/service-progress', function () {
        return view('service-progress');
    })->name('service-progress');

    Route::get('/service-garansi', function () {
        return view('service-garansi');
    })->name('service-garansi');

    Route::get('/reports', function () {
        return view('reports');
    })->name('reports');

    Route::get('/activity-log', function () {
        return view('activity-logs');
    })->name('activity-log');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/service/{service}/print', function (\App\Models\Service $service) {
        return view('service-print', compact('service'));
    })->name('service.print');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================================
// SUPER ADMIN ROUTES (MONITORING ONLY)
// ========================================
// Super Admin Authentication
Route::middleware('guest')->group(function () {
    Route::get('/super-admin/login', [\App\Http\Controllers\SuperAdmin\AuthenticatedSessionController::class, 'create'])
        ->name('super-admin.login');
    Route::post('/super-admin/login', [\App\Http\Controllers\SuperAdmin\AuthenticatedSessionController::class, 'store']);
});

// Super Admin Dashboard & Routes - Hanya role 'super_admin'
Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\SuperAdmin\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Dashboard Monitoring Utama
    Route::get('/dashboard', function () {
        return view('super-admin.dashboard');
    })->name('dashboard');

    // Profile untuk Super Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
