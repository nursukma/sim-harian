<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AbsenPulangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjekController;
use App\Models\Absen;
use App\Models\User;
use Illuminate\Support\Facades\Route;
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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();

// Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
// Route::permanentRedirect('/', '/login');
Route::post('signin', [LoginController::class, 'signin'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// absen
Route::resource('absens-datang', AbsenController::class);
Route::resource('absens-pulang', AbsenPulangController::class);

// projek
Route::resource('projeks', ProjekController::class);
Route::put('projeks/selesai/{id}', [ProjekController::class, 'selesai'])->name('projeks.selesai');
Route::put('projeks/belum/{id}', [ProjekController::class, 'belum'])->name('projeks.belum');