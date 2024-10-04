<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'index'] )->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/signup', [LoginController::class, 'signup'])->middleware('guest')->name('signup');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::get('/invitation/{invitation_code:code}', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'accept'])->middleware('guest')->name('accept-terms');
Route::get('/register/{invitation_code:code}', [RegisterController::class, 'register'])->middleware('guest')->name('signup-account');

Route::post('/register/{invitation_code:code}/create', [RegisterController::class, 'create'])->middleware('guest')->name('create-account');