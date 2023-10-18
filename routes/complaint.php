<?php

use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::get('/complaints', [ComplaintController::class, 'index'])->name('views.complaints.index');
Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('views.complaints.create');
Route::get('/complaints/{id}/summary', [ComplaintController::class, 'summary'])->name('views.complaints.summary');
Route::get('/complaints/{id}/edit', [ComplaintController::class, 'edit'])->name('views.complaints.edit');

Route::post('/complaints/store', [ComplaintController::class, 'store'])->name('actions.complaints.store');
Route::post('/complaints/{id}/update', [ComplaintController::class, 'update'])->name('actions.complaints.update');
Route::get('/complaints/{id}/delete', [ComplaintController::class, 'destroy'])->name('actions.complaints.destroy');
