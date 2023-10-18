<?php

use App\Http\Controllers\TerminationController;
use Illuminate\Support\Facades\Route;


Route::get('/terminations', [TerminationController::class, 'index'])->name('views.terminations.index');
Route::get('/terminations/create', [TerminationController::class, 'create'])->name('views.terminations.create');
Route::get('/terminations/{id}/edit', [TerminationController::class, 'edit'])->name('views.terminations.edit');

Route::post('/terminations/store', [TerminationController::class, 'store'])->name('actions.terminations.store');
Route::post('/terminations/{id}/update', [TerminationController::class, 'update'])->name('actions.terminations.update');
Route::get('/terminations/{id}/delete', [TerminationController::class, 'destroy'])->name('actions.terminations.destroy');
