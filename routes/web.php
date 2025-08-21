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
Route::middleware(['auth'])->gruop(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.dashboard');
        }
        return view('dashboard');
    })->name('dashbord');

    Route::get('/pengaduan-tampil', function (){
        $pengaduan = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduan'));
    })->name('pengaduan.tampil');
});
//Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $totalPengaduan = Pengaduan::count();
        $totalUsers = User::count();
        $totalTanggapan = Tanggapan::count();
        return view('admin.dashboard', compact('totalPengaduan', 'totalUsers', 'totalTanggapan'));
    })->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('pengaduan', PengaduanController::class);
    Route::resource('tanggapan', TanggapanController::class);
});

// Warga Routes
Route::middleware(['auth', 'warga'])->group(function () {
    Route::get('/warga/dashboard', function () {
        $pengaduan = Pengaduan::where('user_id', auth()->id())->get();
        return view('warga.dashboard', compact('pengaduan'));
    })->name('warga.dashboard');    
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__ . '/auth.php';
