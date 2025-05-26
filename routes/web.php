<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use App\http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Pengembalian;

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

Route::get('/', function () {
    return view('welcome');
});

//category
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth')->name('category');
Route::get('/addcategory', [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
Route::post('/category', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->middleware('auth')->name('category.edit');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->middleware('auth')->name('categories.destroy');
Route::put('category/{id}', [CategoryController::class, 'update'])->middleware('auth')->name('category.update');

//barang
Route::get('barang', [BarangController::class, 'index'])->middleware('auth')->name('index');
Route::get('create', [BarangController::class, 'create'])->middleware('auth')->name('create');
Route::post('store', [BarangController::class, 'store'])->middleware('auth')->name('store');
Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->middleware('auth')->name('barang.edit');
Route::put('update/{id}', [BarangController::class, 'update'])->middleware('auth')->name('barang.update');
Route::delete('destroy/{id}', [BarangController::class, 'destroy'])->middleware('auth')->name('destroy');





Route::get('/pengembalian',[PengembalianController::class, 'index'])->middleware('auth')->name('Pengembalian');
Route::post('/pengembalian/{id}/terima', [PengembalianController::class, 'terima'])->middleware('auth')->name('terima.pengembalian');
Route::post('/pengembalian/{id}/tolak', [PengembalianController::class, 'tolak'])->middleware('auth')->name('tolak.pengembalian');


Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/peminjaman',[PeminjamanController::class, 'index'])->middleware('auth')->name('Peminjaman');
Route::post('/peminjaman/{id}/terima', [PeminjamanController::class, 'terima'])->middleware('auth')->name('terima');
Route::post('/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->middleware('auth')->name('tolak');

Route::get('/register', [AuthController::class, 'register'])->name('register.form');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




