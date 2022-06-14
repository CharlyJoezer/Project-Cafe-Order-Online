<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'home']);
Route::get('/UserLogin', [LoginController::class, 'loginView'])->name('login');
Route::get('/profil', [ProfilController::class, 'profilView']);
Route::post('/loginAkun', [UserController::class, 'storeDataLogin']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/daftarAkun', [UserController::class, 'storeDataRegister']);
Route::get('/list-pesanan', [PesananController::class, 'pesananView'])->middleware('auth');
Route::post('/delete/item-keranjang', [PesananController::class, 'deletekeranjang']);
Route::post('/konfirmasi/buatpesanan', [RiwayatController::class, 'buatriwayat']);
Route::post('/getriwayatpesanan', [RiwayatController::class, 'getriwayat']);


Route::post('/sendkeranjang', [PesananController::class, 'tambah_keranjang']);


