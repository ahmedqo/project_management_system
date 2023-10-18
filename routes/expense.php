<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;


Route::get('/expenses', [ExpenseController::class, 'index'])->name('views.expenses.index');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('views.expenses.create');
Route::get('/expenses/{id}/edit', [ExpenseController::class, 'edit'])->name('views.expenses.edit');

Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('actions.expenses.store');
Route::post('/expenses/{id}/update', [ExpenseController::class, 'update'])->name('actions.expenses.update');
Route::get('/expenses/{id}/delete', [ExpenseController::class, 'destroy'])->name('actions.expenses.destroy');
