<?php

use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;


Route::get('/leaves', [LeaveController::class, 'index'])->name('views.leaves.index');
Route::get('/leaves/create', [LeaveController::class, 'create'])->name('views.leaves.create');
Route::get('/leaves/{id}/edit', [LeaveController::class, 'edit'])->name('views.leaves.edit');

Route::post('/leaves/store', [LeaveController::class, 'store'])->name('actions.leaves.store');
Route::post('/leaves/{id}/update', [LeaveController::class, 'update'])->name('actions.leaves.update');
Route::get('/leaves/{id}/delete', [LeaveController::class, 'destroy'])->name('actions.leaves.destroy');
