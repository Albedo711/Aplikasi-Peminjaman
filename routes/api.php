<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

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
Route::middleware('auth:sanctum')->get('/peminjaman',[PeminjamanController::class, 'index']);
Route::middleware('auth:sanctum')->post('/peminjaman/create', [PeminjamanController::class, 'store']);
Route::middleware('auth:sanctum')->post('/pengembalian/create',[PengembalianController::class, 'store']);
Route::middleware('auth:sanctum')->get('/category',[ApiCategoryController::class, 'index']);

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');


