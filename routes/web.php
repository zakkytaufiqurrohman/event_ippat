<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PengdaController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Env;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::name('scans')->prefix('scans')->group(function(){
    Route::get('/get/{id}', [ScanController::class,'index']);
    Route::get('/daftar_ulang', [ScanController::class,'daftar_ulang'])->name('.daftar_ulang');
    Route::post('/daftar_ulang', [ScanController::class, 'daftar_ulang_store_guest'])->name('.daftar_ulang');
});

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login',  [LoginController::class,'login'])->name('login');
Route::get('/', [RegisterController::class,'index']);


Route::name('daftar')->prefix('daftars')->group(function(){
    Route::post('/cek_nama', [RegisterController::class,'cekNama'])->name('.cek_nama');
    Route::post('/register', [RegisterController::class,'register'])->name('.register');
    Route::get('/success', [RegisterController::class,'success']);


});
Route::get('/card/{id}', [CardController::class,'index']);
Route::get('/lives', [LiveController::class,'index'])->name('lives');



Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class,'logout'] )->name('logout');
    Route::get('/dashboard', [LoginController::class,'dashboard'] )->name('dashboard');
    // data pendaftar
    Route::name('pendaftar')->prefix('pendaftars')->group(function(){
        Route::get('/', [PendaftarController::class,'index']);
        Route::post('/', [PendaftarController::class, 'store']);
        Route::delete('/', [PendaftarController::class, 'destroy'])->name('.delete');;
        Route::put('/', [PendaftarController::class, 'update'])->name('.update');
        Route::get('/data', [PendaftarController::class,'data'])->name('.data');
        Route::get('/{id}/edit', [PendaftarController::class,'edit'])->name('.edit');
        Route::post('/cek_nama', [RegisterController::class,'cekNama'])->name('.cek_nama');
        Route::post('/register', [RegisterController::class,'register'])->name('.register');
        Route::get('/success', [RegisterController::class,'success'])->name('success');


    });

    // data 
    Route::name('data')->prefix('datas')->group(function(){
        Route::get('/', [DataController::class,'index']);
        Route::post('/', [DataController::class, 'store']);
        Route::delete('/', [DataController::class, 'destroy'])->name('.delete');;
        Route::put('/', [DataController::class, 'update'])->name('.update');
        Route::get('/data', [DataController::class,'data'])->name('.data');
        Route::post('/import', [DataController::class,'import'])->name('.import');
        Route::get('/{id}/edit', [DataController::class,'edit'])->name('.edit');


    });

    // data pengda
    Route::name('pengda')->prefix('pengdas')->group(function(){
        Route::get('/', [PengdaController::class,'index']);
        Route::post('/', [PengdaController::class, 'store']);
        Route::delete('/', [PengdaController::class, 'destroy'])->name('.delete');;
        Route::put('/', [PengdaController::class, 'update'])->name('.update');
        Route::get('/data', [PengdaController::class,'data'])->name('.data');
        Route::post('/import', [PengdaController::class,'import'])->name('.import');
        Route::get('/{id}/edit', [PengdaController::class,'edit'])->name('.edit');


    });

    // data absen
    Route::name('scan')->prefix('scan')->group(function(){
        Route::get('/get/{id}', [ScanController::class,'index']);
        Route::get('/daftar_ulang', [ScanController::class,'daftar_ulang'])->name('.daftar_ulang');
        Route::post('/daftar_ulang', [ScanController::class, 'daftar_ulang_store'])->name('.daftar_ulang');
        Route::get('/surat_suara', [ScanController::class,'surat_suara'])->name('.surat_suara');
        Route::post('/surat_suara', [ScanController::class, 'surat_suara_store'])->name('.surat_suara');
        Route::get('/kotak_suara', [ScanController::class,'kotak_suara'])->name('.kotak_suara');
        Route::post('/kotak_suara', [ScanController::class, 'kotak_suara_store'])->name('.kotak_suara');
    });
    
    // data admin
    Route::name('admin')->prefix('admins')->group(function(){
        Route::get('/', [AdminController::class,'index']);
        Route::Post('/reset', [AdminController::class,'reset'])->name('.reset');
        Route::post('/', [AdminController::class, 'store']);
        Route::delete('/', [AdminController::class, 'destroy'])->name('.delete');;
        Route::put('/', [AdminController::class, 'update'])->name('.update');
        Route::get('/data', [AdminController::class,'data'])->name('.data');
        Route::post('/import', [AdminController::class,'import'])->name('.import');
        Route::get('/{id}/edit', [AdminController::class,'edit'])->name('.edit');


    });

     // laporan 
     Route::name('laporan')->prefix('laporan')->group(function(){
        Route::get('/daftar_ulang', [LaporanController::class,'daftarUlang'])->name('.daftar_ulang');
        Route::get('/surat_suara', [LaporanController::class,'suratSuara'])->name('.surat_suara');
        Route::get('/kotak_suara', [LaporanController::class,'KotakSuara'])->name('.kotak_suara');
        Route::get('/export', [LaporanController::class,'export'])->name('.export');

        Route::delete('/', [LaporanController::class, 'destroy'])->name('.delete');
        Route::get('/data', [LaporanController::class,'data'])->name('.data');
    });
});

//user