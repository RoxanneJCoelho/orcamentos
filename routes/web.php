<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UtilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BudgetController;

Route::get('/', function () {
    return view('welcome');
});

// rota página inicial
Route::get('/home',[UtilController::class, 'showHomepage'] )->name('show.homepage');

// rotas get e post do formulário - pedido de orçamento
Route::get('/form',[BudgetController::class, 'showForm'] )->name('show.form');
Route::post('/form',[BudgetController::class, 'form'] )->name('form.store');

// rotas get e post do login e logout
Route::get('/login',[AuthController::class, 'showLogin'] )->name('show.login');
Route::post('/login',[AuthController::class, 'login'] )->name('login');
Route::post('/logout',[AuthController::class, 'logout'] )->name('logout');

// rota espaço admin - principal
Route::get('/admin',[AdminController::class, 'showAdmin'] )->name('show.admin')->middleware('auth');

// rotas get e post do adicionar categoria
Route::get('/admin/category/add',[AdminController::class, 'addCategory'] )->name('add.category')->middleware('auth');
Route::post('/admin/category/add',[AdminController::class, 'addCategoryStore'] )->name('add.category.store')->middleware('auth');

// rotas get e post do editar categoria
Route::get('/admin/category/edit/{id}',[AdminController::class, 'editCategory'] )->name('edit.category')->middleware('auth');
Route::put('/admin/category/edit/{id}',[AdminController::class, 'editCategoryStore'] )->name('edit.category.store')->middleware('auth');

Route::get('/admin/category/delete/{id}',[AdminController::class, 'deleteCategory'] )->name('delete.category')->middleware('auth');
Route::get('/admin/service/add',[AdminController::class, 'addService'] )->name('add.service')->middleware('auth');
Route::get('/admin/service/edit/{id}',[AdminController::class, 'editService'] )->name('edit.service')->middleware('auth');
Route::get('/admin/service/delete/{id}',[AdminController::class, 'deleteCategory'] )->name('delete.service')->middleware('auth');
