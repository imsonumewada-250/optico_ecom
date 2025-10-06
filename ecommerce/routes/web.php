<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

// 🔹 Default route (index page)
Route::get('/', function () {
    return view('index');
})->name('index');

// 🔹 Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// 🔹 Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// 🔹 Logout route (POST method — secure)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🔹 Home / Dashboard route (after login)
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
use App\Http\Controllers\Auth\redirecttoregform;

Route::post('/register', [redirecttoregform::class, 'registerPost'])->name('register.post');
