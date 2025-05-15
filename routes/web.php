<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetaController;

Route::get('/', function () {
    return view('home', ['title' => "Home Page"]);
});

// Halaman login & signup dalam satu halaman
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Proses login & signup
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (hanya bisa diakses jika sudah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/peta', [PetaController::class, 'index'])->middleware('auth');
