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

    // Manajemen Sistem Pakar (Knowledge Base)
    Route::get('/expert-system/devices', \App\Livewire\ExpertSystem\DeviceTypeManager::class)->name('expert-system.devices');
    Route::get('/expert-system/devices/{device_type_id}/components', \App\Livewire\ExpertSystem\DeviceComponentManager::class)->name('expert-system.components');
    Route::get('/expert-system/components/{component_id}/diseases', \App\Livewire\ExpertSystem\ComponentDiseaseManager::class)->name('expert-system.diseases');
    Route::get('/expert-system/diseases/{disease_id}/rules', \App\Livewire\ExpertSystem\DiseaseRuleManager::class)->name('expert-system.rules');
    Route::get('/expert-system/services', \App\Livewire\ExpertSystem\ServiceCategoryManager::class)->name('expert-system.services');
    Route::get('/expert-system/services/{category}/items', \App\Livewire\ExpertSystem\ServiceItemManager::class)->name('expert-system.services.items');

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

    Route::get('/activity-log', function () {
        return view('super-admin.activity-logs');
    })->name('activity-log');

    // Monitoring Servis
    Route::get('/services/monitor', function () {
        return view('super-admin.services-monitor');
    })->name('services.monitor');

    // Laporan
    Route::get('/reports', function () {
        return view('super-admin.reports');
    })->name('reports');

    // Setting
    Route::get('/settings', function () {
        return view('super-admin.settings');
    })->name('settings');

    // Management User
    Route::get('/users', function () {
        return view('super-admin.users'); // or pointing to a livewire user component if exists
    })->name('users');

    // Profile untuk Super Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
