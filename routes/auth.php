<?php

use App\Http\Controllers\auth\ForgotController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\ResetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'create'])->name('views.login');
Route::get('/forgot', [ForgotController::class, 'create'])->name('views.forgot');
Route::get('/reset/{token}', [ResetController::class, 'create'])->name('views.reset');

Route::post('/', [LoginController::class, 'store'])->name('actions.login');
Route::post('/forgot', [ForgotController::class, 'store'])->name('actions.forgot');
Route::post('/reset/{token}', [ResetController::class, 'store'])->name('actions.reset');
