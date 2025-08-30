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

// Route login (user dan admin) 
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

    
    Route::resource('pengaduans', PengaduanController::class);
    Route::delete('/pengaduans/{pengaduan}/riwayat', [PengaduanController::class, 'destroyRiwayat'])
        ->name('pengaduans.destroyRiwayat');
    Route::post('/pengaduans/{pengaduan}/tanggapans', [TanggapanController::class, 'store'])
        ->name('tanggapans.store');


    // Profile (opsional, aktifkan kalau memang dipakai)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $totalPengaduan = Pengaduan::count();
        $totalUsers = User::where('role', 'warga')->count();
        $selesaiAduan = Pengaduan::where('status', 'selesai')->count();
        $prosesAduan = Pengaduan::where('status', 'proses')->count();
        $pendingAduan = Pengaduan::where('status', 'pending')->count();
        
        return view('admin.dashboard', compact('totalPengaduan', 'totalUsers', 'selesaiAduan', 'prosesAduan', 'pendingAduan'));
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
        $totalPengaduan = Pengaduan::count();
        $selesaiAduan = Pengaduan::where('status', 'selesai')->count();
        $prosesAduan = Pengaduan::where('status', 'proses')->count();
        $pendingAduan = Pengaduan::where('status', 'pending')->count();
        $pengaduanTerbaru = Pengaduan::latest()->take(6)->get();
        return view('warga.dashboard', compact('totalPengaduan', 'selesaiAduan', 'prosesAduan', 'pendingAduan', 'pengaduanTerbaru'));
    })->name('warga.dashboard');

    Route::get('/warga/riwayat', function () {
        $riwayat = Pengaduan::where('user_id', auth()->id())->latest()->get();
        return view('warga.riwayat', compact('riwayat'));
    })->name('warga.riwayat');
});

require __DIR__ . '/auth.php';
