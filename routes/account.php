<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/accounts', [AccountController::class, 'index'])->name('views.accounts.index');
Route::get('/accounts/create', [AccountController::class, 'create'])->name('views.accounts.create');
Route::get('/accounts/{id}/edit', [AccountController::class, 'edit'])->name('views.accounts.edit');

Route::post('/accounts/store', [AccountController::class, 'store'])->name('actions.accounts.store');
Route::post('/accounts/{id}/update', [AccountController::class, 'update'])->name('actions.accounts.update');
Route::get('/accounts/{id}/delete', [AccountController::class, 'destroy'])->name('actions.accounts.destroy');
