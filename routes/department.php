<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;


Route::get('/departments', [DepartmentController::class, 'index'])->name('views.departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('views.departments.create');
Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('views.departments.edit');

Route::post('/departments/store', [DepartmentController::class, 'store'])->name('actions.departments.store');
Route::post('/departments/{id}/update', [DepartmentController::class, 'update'])->name('actions.departments.update');
Route::get('/departments/{id}/delete', [DepartmentController::class, 'destroy'])->name('actions.departments.destroy');
