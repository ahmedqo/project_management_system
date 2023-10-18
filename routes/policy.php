<?php

use App\Http\Controllers\PolicyController;
use Illuminate\Support\Facades\Route;


Route::get('/policies', [PolicyController::class, 'index'])->name('views.policies.index');
Route::get('/policies/create', [PolicyController::class, 'create'])->name('views.policies.create');
Route::get('/policies/{id}/summary', [PolicyController::class, 'summary'])->name('views.policies.summary');
Route::get('/policies/{id}/edit', [PolicyController::class, 'edit'])->name('views.policies.edit');

Route::post('/policies/store', [PolicyController::class, 'store'])->name('actions.policies.store');
Route::post('/policies/{id}/update', [PolicyController::class, 'update'])->name('actions.policies.update');
Route::get('/policies/{id}/delete', [PolicyController::class, 'destroy'])->name('actions.policies.destroy');
