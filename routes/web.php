<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\DataController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

// Route::get('/register', function () {
//     return view('auth.register');
// });
Route::get('/register', [RegisterController::class,'index']);


Route::name('daftar')->prefix('daftars')->group(function(){
    Route::get('/', [RoleController::class,'index']);
    // Route::post('/', [RoleController::class, 'store']);
    // Route::delete('/', [RoleController::class, 'destroy']);
    // Route::put('/', [RoleController::class, 'update']);
    // Route::get('/data', [RoleController::class,'data'])->name('.data');
    // Route::get('/getPermission', [RoleController::class,'getPermission'])->name('.getPermission');
    Route::post('/cek_nama', [RegisterController::class,'cekNama'])->name('.cek_nama');
    Route::post('/register', [RegisterController::class,'register'])->name('.register');
    Route::get('/success', [RegisterController::class,'success']);


});

// data pendaftar
Route::name('pendaftar')->prefix('pendaftars')->group(function(){
    Route::get('/', [PendaftarController::class,'index']);
    Route::post('/', [PendaftarController::class, 'store']);
    Route::delete('/', [PendaftarController::class, 'destroy'])->name('.delete');;
    Route::put('/', [PendaftarController::class, 'update'])->name('.update');
    Route::get('/data', [PendaftarController::class,'data'])->name('.data');
    Route::get('/{id}/edit', [PendaftarController::class,'edit'])->name('.edit');
    // Route::get('/getPermission', [PendaftarController::class,'getPermission'])->name('.getPermission');
    Route::post('/cek_nama', [RegisterController::class,'cekNama'])->name('.cek_nama');
    Route::post('/register', [RegisterController::class,'register'])->name('.register');
    Route::get('/success', [RegisterController::class,'success'])->name('success');


});

// database sk

// data pendaftar
Route::name('data')->prefix('datas')->group(function(){
    Route::get('/', [DataController::class,'index']);
    Route::post('/', [DataController::class, 'store']);
    Route::delete('/', [DataController::class, 'destroy'])->name('.delete');;
    Route::put('/', [DataController::class, 'update'])->name('.update');
    Route::get('/data', [DataController::class,'data'])->name('.data');
    Route::post('/import', [DataController::class,'import'])->name('.import');
    Route::get('/{id}/edit', [DataController::class,'edit'])->name('.edit');


});

//user