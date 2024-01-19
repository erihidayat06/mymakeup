<?php

use App\Models\Category;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnalisController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TokoviewController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomePilihanController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return view('home', [
        'categories' => Category::all(),
        'notif' => Transaksi::latest()->notifikasi()->get(),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'judul' => 'Admin'
    ]);
})->middleware('admin');


Route::get('/pilihan', [HomePilihanController::class, 'index']);
Route::get('/pilih/{pilihan:slug}', [HomePilihanController::class, 'show']);

Route::resource('/dashboard/pilihan', PilihanController::class)->middleware('auth', 'verified');
Route::resource('/dashboard/transaksi', TransaksiController::class)->middleware('auth', 'verified');
Route::post('/transaksi', [TransaksiController::class, 'create']);
Route::delete('/transaksi/{transaksi:id}', [TransaksiController::class, 'destroy']);

Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::get('/pesanan/{transaksi:no_pesanan}', [TransaksiController::class, 'show'])->middleware('auth');

Route::resource('dashboard/category', CategoryController::class)->middleware('auth', 'verified');
Route::resource('dashboard/profil', TokoController::class)->middleware('auth', 'verified');
Route::get('buat-toko', [TokoController::class, 'create'])->middleware('auth', 'verified');

Route::get('/dashboard/analis', [AnalisController::class, 'index'])->middleware('auth', 'verified');

Route::post('/komentar', [KomentarController::class, 'create'])->middleware('auth', 'verified');
Route::get('/toko/{toko:slug}', [TokoviewController::class, 'index']);


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.post');


Auth::routes(['verify' => true]);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
