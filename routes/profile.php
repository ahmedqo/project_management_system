<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/profile/summary', [ProfileController::class, 'summary'])->name('views.profile.summary');
Route::get('/profile/contracts', [ProfileController::class, 'contract'])->name('views.profile.contracts');
Route::get('/profile/accounts', [ProfileController::class, 'account'])->name('views.profile.accounts');
Route::get('/profile/documents', [ProfileController::class, 'summary'])->name('views.profile.documents');
Route::get('/profile/password', [ProfileController::class, 'password'])->name('views.profile.password');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('views.profile.edit');
Route::get('/profile/logout', [LoginController::class, 'destroy'])->name('actions.profile.logout');
Route::post('/profile/password', [ProfileController::class, 'change'])->name('actions.profile.password');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('actions.profile.update');


Route::get('/profile/leaves', [ProfileController::class, 'leave_index'])->name('views.profile.leaves.index');
Route::get('/profile/leaves/create', [ProfileController::class, 'leave_create'])->name('views.profile.leaves.create');
Route::get('/profile/leaves/{id}/edit', [ProfileController::class, 'leave_edit'])->name('views.profile.leaves.edit');
Route::post('/profile/leaves/store', [ProfileController::class, 'leave_store'])->name('actions.profile.leaves.store');
Route::post('/profile/leaves/{id}/update', [ProfileController::class, 'leave_update'])->name('actions.profile.leaves.update');
Route::get('/profile/leaves/{id}/delete', [ProfileController::class, 'leave_destroy'])->name('actions.profile.leaves.destroy');

Route::get('/profile/expenses', [ProfileController::class, 'expense_index'])->name('views.profile.expenses.index');
Route::get('/profile/expenses/create', [ProfileController::class, 'expense_create'])->name('views.profile.expenses.create');
Route::get('/profile/expenses/{id}/edit', [ProfileController::class, 'expense_edit'])->name('views.profile.expenses.edit');
Route::post('/profile/expenses/store', [ProfileController::class, 'expense_store'])->name('actions.profile.expenses.store');
Route::post('/profile/expenses/{id}/update', [ProfileController::class, 'expense_update'])->name('actions.profile.expenses.update');
Route::get('/profile/expenses/{id}/delete', [ProfileController::class, 'expense_destroy'])->name('actions.profile.expenses.destroy');

Route::get('/profile/reviews', [ProfileController::class, 'review_index'])->name('views.profile.reviews.index');
Route::get('/profile/reviews/{id}/summary', [ProfileController::class, 'review_summary'])->name('views.profile.reviews.summary');

Route::get('/profile/complaints', [ProfileController::class, 'complaint_index'])->name('views.profile.complaints.index');
Route::get('/profile/complaints/{id}/summary', [ProfileController::class, 'complaint_summary'])->name('views.profile.complaints.summary');
Route::get('/profile/complaints/create', [ProfileController::class, 'complaint_create'])->name('views.profile.complaints.create');
Route::get('/profile/complaints/{id}/edit', [ProfileController::class, 'complaint_edit'])->name('views.profile.complaints.edit');
Route::post('/profile/complaints/store', [ProfileController::class, 'complaint_store'])->name('actions.profile.complaints.store');
Route::post('/profile/complaints/{id}/update', [ProfileController::class, 'complaint_update'])->name('actions.profile.complaints.update');
Route::get('/profile/complaints/{id}/delete', [ProfileController::class, 'complaint_destroy'])->name('actions.profile.complaints.destroy');

Route::get('/profile/projects', [ProfileController::class, 'project_index'])->name('views.profile.projects.index');
Route::get('/profile/projects/{id}/summary', [ProfileController::class, 'project_summary'])->name('views.profile.projects.summary');
Route::get('/profile/projects/{id}/tasks', [ProfileController::class, 'project_task'])->name('views.profile.projects.tasks');
Route::get('/profile/projects/{id}/status/{status}', [ProfileController::class, 'project_status'])->name('actions.profile.projects.status');

Route::get('/profile/tasks', [ProfileController::class, 'task'])->name('views.profile.tasks');
Route::get('/profile/tasks', [ProfileController::class, 'task_index'])->name('views.profile.tasks.index');
Route::get('/profile/tasks/create', [ProfileController::class, 'task_create'])->name('views.profile.tasks.create');
Route::get('/profile/tasks/{id}/edit', [ProfileController::class, 'task_edit'])->name('views.profile.tasks.edit');
Route::get('/profile/tasks/{id}/summary', [ProfileController::class, 'task_summary'])->name('views.profile.tasks.summary');
Route::get('/profile/tasks/{id}/notes', [ProfileController::class, 'note_index'])->name('views.profile.tasks.notes.index');
Route::post('/profile/tasks/{id}/notes/store', [ProfileController::class, 'note_store'])->name('actions.profile.tasks.notes.store');
Route::post('/profile/tasks/store', [ProfileController::class, 'task_store'])->name('actions.profile.tasks.store');
Route::post('/profile/tasks/{id}/update', [ProfileController::class, 'task_update'])->name('actions.profile.tasks.update');
