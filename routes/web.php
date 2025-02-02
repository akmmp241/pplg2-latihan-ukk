<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return "ini halaman /";
});

Route::resource('siswa', SiswaController::class)->middleware('auth');

Route::get('/login', [AuthenticationController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');