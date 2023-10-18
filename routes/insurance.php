<?php

use App\Http\Controllers\InsuranceController;
use Illuminate\Support\Facades\Route;


Route::get('/insurances', [InsuranceController::class, 'index'])->name('views.insurances.index');
Route::get('/insurances/create', [InsuranceController::class, 'create'])->name('views.insurances.create');
Route::get('/insurances/{id}/edit', [InsuranceController::class, 'edit'])->name('views.insurances.edit');

Route::post('/insurances/store', [InsuranceController::class, 'store'])->name('actions.insurances.store');
Route::post('/insurances/{id}/update', [InsuranceController::class, 'update'])->name('actions.insurances.update');
Route::get('/insurances/{id}/delete', [InsuranceController::class, 'destroy'])->name('actions.insurances.destroy');
