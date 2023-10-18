<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/clients', [ClientController::class, 'index'])->name('views.clients.index');
Route::get('/clients/create', [ClientController::class, 'create'])->name('views.clients.create');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('views.clients.edit');

Route::get('/clients/{id}/summary', [ClientController::class, 'summary'])->name('views.clients.summary');
Route::get('/clients/{id}/contacts', [ClientController::class, 'contact'])->name('views.clients.contacts');
Route::get('/clients/{id}/accounts', [ClientController::class, 'account'])->name('views.clients.accounts');
Route::get('/clients/{id}/projects', [ClientController::class, 'project'])->name('views.clients.projects');
Route::get('/clients/{id}/documents', [ClientController::class, 'document'])->name('views.clients.documents');

Route::post('/clients/store', [ClientController::class, 'store'])->name('actions.clients.store');
Route::post('/clients/{id}/update', [ClientController::class, 'update'])->name('actions.clients.update');
Route::get('/clients/{id}/delete', [ClientController::class, 'destroy'])->name('actions.clients.destroy');
