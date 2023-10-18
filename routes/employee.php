<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::get('/employees', [EmployeeController::class, 'index'])->name('views.employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('views.employees.create');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('views.employees.edit');
Route::get('/employees/{id}/summary', [EmployeeController::class, 'summary'])->name('views.employees.summary');
Route::get('/employees/{id}/contracts', [EmployeeController::class, 'contract'])->name('views.employees.contracts');
Route::get('/employees/{id}/leaves', [EmployeeController::class, 'leave'])->name('views.employees.leaves');
Route::get('/employees/{id}/accounts', [EmployeeController::class, 'account'])->name('views.employees.accounts');
Route::get('/employees/{id}/projects', [EmployeeController::class, 'project'])->name('views.employees.projects');
Route::get('/employees/{id}/tasks', [EmployeeController::class, 'task'])->name('views.employees.tasks');
Route::get('/employees/{id}/expenses', [EmployeeController::class, 'expense'])->name('views.employees.expenses');
Route::get('/employees/{id}/documents', [EmployeeController::class, 'summary'])->name('views.employees.documents');
Route::get('/employees/{id}/status/{status}', [EmployeeController::class, 'status'])->name('actions.employees.status');
Route::get('/employees/{id}/reviews', [EmployeeController::class, 'review_index'])->name('views.employees.reviews.index');
Route::get('/employees/reviews/{id}/summary', [EmployeeController::class, 'review_summary'])->name('views.employees.reviews.summary');
Route::get('/employees/{id}/complaints', [EmployeeController::class, 'complaint_index'])->name('views.employees.complaints.index');
Route::get('/employees/complaints/{id}/summary', [EmployeeController::class, 'complaint_summary'])->name('views.employees.complaints.summary');

Route::post('/employees/store', [EmployeeController::class, 'store'])->name('actions.employees.store');
Route::post('/employees/{id}/update', [EmployeeController::class, 'update'])->name('actions.employees.update');
Route::get('/employees/{id}/delete', [EmployeeController::class, 'destroy'])->name('actions.employees.destroy');
