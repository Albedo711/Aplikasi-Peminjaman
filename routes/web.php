<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use App\http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\userController;
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
Route::put('barang/{id}', [BarangController::class, 'update'])->middleware('auth')->name('barang.update');
Route::delete('barang/{id}', [BarangController::class, 'destroy'])
    ->middleware('auth')
    ->name('barang.destroy'); 
Route::get('/barang/{id}', [BarangController::class, 'show'])->name('barang.show');

Route::get('user', [userController::class, 'index'])->middleware('auth')->name('user');
Route::get('user/create', [userController::class, 'create'])->middleware('auth')->name('user.create');
Route::post('user/store', [userController::class, 'store'])->middleware('auth')->name('user.store');
Route::get('user/{id}/edit', [userController::class, 'edit'])->middleware('auth')->name('user.edit');
Route::put('update/{id}', [userController::class, 'update'])->middleware('auth')->name('user.update');
Route::delete('destroy/{id}', [userController::class, 'destroy'])->middleware('auth')->name('user.destroy');






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





use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

Route::get('/image/barang/{filename}', function ($filename) {
    $path = 'public/barang/' . $filename;

    if (!Storage::exists($path)) {
        abort(404);
    }

    $file = Storage::get($path);
    $mime = Storage::mimeType($path);

    return Response::make($file, 200, [
        'Content-Type' => $mime,
        'Access-Control-Allow-Origin' => '*',
    ]);
});

Route::get('/image/foto_barang/{filename}', function ($filename) {
    $path = storage_path('app/public/foto_barang/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $mime = mime_content_type($path);

    return response($file, 200)
          ->header('Content-Type', $mime)
          ->header('Access-Control-Allow-Origin', '*');
});

