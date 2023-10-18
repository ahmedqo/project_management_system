<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/projects', [ProjectController::class, 'index'])->name('views.projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('views.projects.create');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('views.projects.edit');
Route::get('/projects/{id}/summary', [ProjectController::class, 'summary'])->name('views.projects.summary');
Route::get('/projects/{id}/tasks', [ProjectController::class, 'task'])->name('views.projects.tasks');

Route::post('/projects/store', [ProjectController::class, 'store'])->name('actions.projects.store');
Route::post('/projects/{id}/update', [ProjectController::class, 'update'])->name('actions.projects.update');
Route::get('/projects/{id}/delete', [ProjectController::class, 'destroy'])->name('actions.projects.destroy');
