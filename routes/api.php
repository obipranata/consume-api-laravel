<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PenggunaController;
use App\Http\Controllers\Backend\ProdukController;
use App\Http\Controllers\Backend\ArtikelController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/pengguna", [PenggunaController::class, "index"]);
Route::get("/pengguna/{id}", [PenggunaController::class, "show"]);
Route::post("/pengguna", [PenggunaController::class, "store"]);
Route::post("/pengguna/{id}/edit", [PenggunaController::class, "update"]);
Route::post("/pengguna/{id}/delete", [PenggunaController::class, "destroy"]);

Route::get("/produk", [ProdukController::class, "index"]);
Route::get("/produk/{id}", [ProdukController::class, "show"]);
Route::post("/produk", [ProdukController::class, "store"]);
Route::put("/produk/{id}", [ProdukController::class, "update"]);
Route::delete("/produk/{id}", [ProdukController::class, "destroy"]);

Route::get("/artikel", [ArtikelController::class, "index"]);
Route::get("/artikel/{id}", [ArtikelController::class, "show"]);
Route::post("/artikel", [ArtikelController::class, "store"]);
Route::put("/artikel/{id}", [ArtikelController::class, "update"]);
Route::delete("/artikel/{id}", [ArtikelController::class, "destroy"]);
