<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// 🔹 Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// 🔹 Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// 🔹 Logout (secure POST method)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🔹 Product listing (Main Page)
Route::get('/', [ProductController::class, 'index'])->name('home');

// 🔹 Optional: Dashboard (if you want a separate user area after login)
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');




Route::get('/admin/add-product', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/add-product', [ProductController::class, 'store'])->name('products.store');
