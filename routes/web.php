<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TranskripPresensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;

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


Route::get('/', [AgendaController::class, 'beranda'])->name('beranda');
Route::middleware('isLogin')->group(function () {
//Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');
});

//logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// ===== ROUTE YANG HANYA BISA DIAKSES SETELAH LOGIN =====
Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan/store', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}', [RuanganController::class, 'show'])->name('ruangan.show');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::post('/ruangan/{id}/update', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}/destroy', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    Route::get('/ruangan/{id}/booking', [BookingController::class, 'showBooking'])->name('booking.show');
    Route::get('/ruangan/{id}/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    Route::get('agenda', [AgendaController::class, 'index'])->name('agenda');

    Route::middleware('checkJabatan:admin')->group(function () {
        //User
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('user/create', [UserController::class, 'create'])->name('userCreate');
        Route::post('user/store', [UserController::class, 'store'])->name('userStore');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
        Route::post('user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
        Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('userDestroy');
        Route::get('user/excel', [UserController::class, 'excel'])->name('userExcel');
        Route::get('user/pdf', [UserController::class, 'pdf'])->name('userPdf');


        //Agenda Pimpinan
        Route::get('/agenda/create/{user?}', [AgendaController::class, 'create'])->name('agendaCreate');
        Route::post('agenda/store', [AgendaController::class, 'store'])->name('agendaStore');
        Route::get('agenda/{user}', [AgendaController::class, 'show'])->name('agenda.show');
        Route::post('agenda/kehadiran', [AgendaController::class, 'uploadKehadiran'])->name('agendaKehadiran');
        Route::get('agenda/edit/{id}', [AgendaController::class, 'edit'])->name('agendaEdit');
        Route::post('agenda/update/{id}', [AgendaController::class, 'update'])->name('agendaUpdate');
        Route::delete('agenda/destroy/{id}', [AgendaController::class, 'destroy'])->name('agendaDestroy');
        Route::get('agenda/excel', [AgendaController::class, 'excel'])->name('agendaExcel');
        Route::get('agenda/pdf', [AgendaController::class, 'pdf'])->name('agendaPdf');
        Route::post('agenda/delegate', [AgendaController::class, 'delegate'])->name('agendaDelegate');
        
        Route::get('/transkrip', [TranskripPresensiController::class, 'index'])->name('transkrip.index');
        Route::get('/transkrip/{user}', [TranskripPresensiController::class, 'show'])->name('transkrip.show');

        
    });

    Route::middleware('checkJabatan:pimpinan')->group(function () {
       
        //Agenda Pimpinan
        Route::get('/agenda/create/{user?}', [AgendaController::class, 'create'])->name('agendaCreate');
        Route::post('agenda/store', [AgendaController::class, 'store'])->name('agendaStore');
        Route::get('agenda/{user}', [AgendaController::class, 'show'])->name('agenda.show');
        Route::post('agenda/kehadiran', [AgendaController::class, 'uploadKehadiran'])->name('agendaKehadiran');
        Route::get('agenda/edit/{id}', [AgendaController::class, 'edit'])->name('agendaEdit');
        Route::post('agenda/update/{id}', [AgendaController::class, 'update'])->name('agendaUpdate');
        Route::delete('agenda/destroy/{id}', [AgendaController::class, 'destroy'])->name('agendaDestroy');
        Route::get('agenda/excel', [AgendaController::class, 'excel'])->name('agendaExcel');
        Route::get('agenda/pdf', [AgendaController::class, 'pdf'])->name('agendaPdf');
        Route::post('agenda/delegate', [AgendaController::class, 'delegate'])->name('agendaDelegate');
       
        Route::get('/transkrip', [TranskripPresensiController::class, 'index'])->name('transkrip.index');
        Route::get('/transkrip/{user}', [TranskripPresensiController::class, 'show'])->name('transkrip.show');


    });
        
});

