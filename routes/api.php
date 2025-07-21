<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\Api\DetailPeminjamanController;
use App\Models\Pengembalian;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/barang', [ApiBarangController::class, 'index']);
Route::middleware('auth:sanctum')->get('/peminjaman',[PeminjamanController::class, 'suki']);
Route::middleware('auth:sanctum')->post('/peminjaman/create', [PeminjamanController::class, 'store']);
Route::middleware('auth:sanctum')->get('/pengembalian',[PengembalianController::class, 'suki']);
Route::middleware('auth:sanctum')->post('/pengembalian/create',[PengembalianController::class, 'store']);
Route::middleware('auth:sanctum')->get('/category',[ApiCategoryController::class, 'index']);
Route::middleware('auth:sanctum')->get('/pengembalian/barang', [PengembalianController::class, 'barangBelumDikembalikan']);
Route::middleware('auth:sanctum')->get('/detail/peminjaman',[PeminjamanController::class, 'detail']);

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');


