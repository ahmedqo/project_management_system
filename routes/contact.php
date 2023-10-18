<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::get('/contacts', [ContactController::class, 'index'])->name('views.contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('views.contacts.create');
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('views.contacts.edit');

Route::post('/contacts/store', [ContactController::class, 'store'])->name('actions.contacts.store');
Route::post('/contacts/{id}/update', [ContactController::class, 'update'])->name('actions.contacts.update');
Route::get('/contacts/{id}/delete', [ContactController::class, 'destroy'])->name('actions.contacts.destroy');
