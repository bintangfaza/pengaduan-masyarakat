<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Tanggapan;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk semua user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.dashboard');
        }

        return view('dashboard');
    })->name('dashboard');

    // Kalau ingin semua user (admin & warga) bisa lihat daftar pengaduan
    Route::resource('pengaduans', PengaduanController::class);

    // Profile (opsional, aktifkan kalau memang dipakai)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $totalPengaduan = Pengaduan::count();
        $totalUsers = User::count();
        $totalTanggapan = Tanggapan::count();
        return view('admin.dashboard', compact('totalPengaduan', 'totalUsers', 'totalTanggapan'));
    })->name('admin.dashboard');
    
    Route::resource('/admin/users', UserController::class)
        ->only(['index', 'destroy'])
        ->names([
            'index' => 'admin.users.index',
            'destroy' => 'admin.users.destroy',
        ]);
    

    
});

// Warga
Route::middleware(['auth', 'warga'])->group(function () {
    Route::get('/warga/dashboard', function () {
        $todayAduan = Pengaduan::whereDate('created_at', now()->toDateString())->get();
        return view('warga.dashboard', compact('todayAduan'));
    })->name('warga.dashboard');

});

require __DIR__ . '/auth.php';
