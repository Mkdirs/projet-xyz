<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'index'] )->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
