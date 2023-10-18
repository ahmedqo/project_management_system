<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/reviews', [ReviewController::class, 'index'])->name('views.reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('views.reviews.create');
Route::get('/reviews/{id}/summary', [ReviewController::class, 'summary'])->name('views.reviews.summary');
Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('views.reviews.edit');

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('actions.reviews.store');
Route::post('/reviews/{id}/update', [ReviewController::class, 'update'])->name('actions.reviews.update');
Route::get('/reviews/{id}/delete', [ReviewController::class, 'destroy'])->name('actions.reviews.destroy');
