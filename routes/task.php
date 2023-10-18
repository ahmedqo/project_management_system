<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/tasks', [TaskController::class, 'index'])->name('views.tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('views.tasks.create');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('views.tasks.edit');
Route::get('/tasks/{id}/summary', [TaskController::class, 'summary'])->name('views.tasks.summary');
Route::get('/tasks/{id}/notes', [TaskController::class, 'note_index'])->name('views.tasks.notes.index');

Route::post('/tasks/store', [TaskController::class, 'store'])->name('actions.tasks.store');
Route::post('/tasks/{id}/update', [TaskController::class, 'update'])->name('actions.tasks.update');
Route::post('/tasks/{id}/status', [TaskController::class, 'status'])->name('actions.tasks.status');
Route::get('/tasks/{id}/delete', [TaskController::class, 'destroy'])->name('actions.tasks.destroy');
Route::post('/tasks/{id}/notes/store', [TaskController::class, 'note_store'])->name('actions.tasks.notes.store');
Route::get('/tasks/{task}/notes/{id}/destroy', [TaskController::class, 'note_destroy'])->name('actions.tasks.notes.destroy');
