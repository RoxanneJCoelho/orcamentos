<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[AuthController::class, 'showHomepage'] )->name('show.homepage');
Route::get('/form',[BudgetController::class, 'create'] )->name('show.form');
Route::post('/form',[AuthController::class, 'form'] )->name('form.store');
Route::get('/login',[AuthController::class, 'showLogin'] )->name('show.login');
Route::post('/login',[AuthController::class, 'login'] )->name('login');
Route::post('/logout',[AuthController::class, 'logout'] )->name('logout');
Route::get('/admin',[AuthController::class, 'showAdmin'] )->name('show.admin')->middleware('auth');
