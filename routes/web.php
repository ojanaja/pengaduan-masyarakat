<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('pekat.index');

Route::middleware(['isMasyarakat'])->group(function () {
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
    Route::get('/laporan/{siapa?}', [UserController::class, 'laporan'])->name('pekat.laporan');
    Route::get('/logout', [UserController::class, 'logout'])->name('pekat.logout');
    Route::get('/user/cetak-laporan-individu/{id_pengaduan}', [UserController::class, 'cetakLaporanIndividu'])
        ->name('user.cetakLaporanIndividu');
});

Route::middleware(['guest'])->group(function () {
    // Login
    Route::post('/login/auth', [UserController::class, 'login'])->name('pekat.login');

    // Register
    Route::get('/register', [UserController::class, 'formRegister'])->name('pekat.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('pekat.register');
    Route::get('/formUpdate', [UserController::class, 'formUpdate'])->name('pekat.formUpdate');
    Route::post('/update', [UserController::class, 'update'])->name('pekat.update');
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['isAdmin'])->group(function () {
        //  // Dashboard
        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // // Pengaduan
        // Route::resource('pengaduan', PengaduanController ::class);

        // // Tanggapan
        // Route::post('tanggapan\createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');

        // // Logout
        // Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Petugas
        Route::resource('petugas', PetugasController::class);

        // Masyarakat
        Route::resource('masyarakat', MasyarakatController::class);

        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
        Route::get('/laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');
        Route::get('laporan/cetak-individu/{id_pengaduan}', [LaporanController::class, 'cetakLaporanIndividu'])->name('laporan.cetakLaporanIndividu');
    });

    Route::middleware(['isPetugas'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Pengaduan
        Route::resource('pengaduan', PengaduanController::class);

        // Tanggapan
        Route::post('tanggapan\createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');

        // Masyarakat
        Route::resource('masyarakat', MasyarakatController::class);

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware(['isGuest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });
});
