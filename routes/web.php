<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kendali;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/',[Kendali::class, 'halamanlogin'])->name('login');
Route::post('/postlogin',[Kendali::class, 'postlogin'])->name('postlogin');
Route::get('/sesi/logout',[Kendali::class, 'logout']);
Route::get('/sesi/register',[Kendali::class, 'register']);
Route::post('/sesi/create',[Kendali::class, 'create']);


Route::get('artikel',[Kendali::class, 'Tampilkan']);
Route::get('/editArtikel/{id}', [Kendali::class, 'Edit']);
Route::post('/Update/{id}',[Kendali::class, 'Update'])->name('Update');
Route::get('/hapusArtikel/{id}',[Kendali::class,'Hapus']);
Route::get('tambahArtikel',[Kendali::class,'tambahData']);
Route::post('/simpanArtikel',[Kendali::class,'simpanArtikel'])->name('simpanArtikel');
Route::get('/detailArtikel/{id}', [Kendali::class, 'detailArtikel'])->name('detailArtikel');

