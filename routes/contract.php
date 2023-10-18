<?php

use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;


Route::get('/contracts', [ContractController::class, 'index'])->name('views.contracts.index');
Route::get('/contracts/create', [ContractController::class, 'create'])->name('views.contracts.create');
Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->name('views.contracts.edit');

Route::post('/contracts/store', [ContractController::class, 'store'])->name('actions.contracts.store');
Route::post('/contracts/{id}/update', [ContractController::class, 'update'])->name('actions.contracts.update');
Route::get('/contracts/{id}/delete', [ContractController::class, 'destroy'])->name('actions.contracts.destroy');
