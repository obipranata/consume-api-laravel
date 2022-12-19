<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/artikel', function () {
//     return view('artikel.index');
// });



// Route::get('/', [ProdukController::class, 'index'])->name("produk.list");

Route::get("/", function () {
    return view("frontend.index");
})->name('index');

Route::get("/add", function () {
    return view("frontend.add");
})->name('add');

Route::get("/detail/{id}", function () {
    return view("frontend.show");
})->name('detail');


Route::middleware(['withAuth'])->prefix("produk")->name('produk.')->controller(ProdukController::class)->group(function () {
    Route::get('/list', 'index')->name("daftar");
    Route::get('/detail/{id}', 'detail')->name("detail");
    Route::get('/store', 'store')->name("store");

    Route::post('/create', 'create')->name("create");
    Route::put('/update/{id}', 'update')->name("update");
    Route::get('/destroy/{id}', 'destroy')->name("destroy");
});

Route::get("/artikel", [ArtikelController::class, "index"])->name("artikel.index");
Route::get("/show/{id}", [ArtikelController::class, "show"])->name("artikel.show");

Route::middleware(['withAuth'])->prefix("artikel")->name('artikel.')->controller(ArtikelController::class)->group(function () {
    // Route::get('/daftar', 'index')->name("daftar");
    Route::get('/edit/{id}', 'edit')->name("edit");
    Route::get('/store', 'store')->name("store");

    Route::post('/create', 'create')->name("create");
    Route::put('/update/{id}', 'update')->name("update");
    Route::get('/destroy/{id}', 'destroy')->name("destroy");
});

Route::any("login", [AuthController::class, "login"])->name("login")->middleware(["noAuth"]);
Route::any("logout", [AuthController::class, "logout"])->name("logout")->middleware(["withAuth"]);
