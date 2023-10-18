<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;


Route::get('/conversations', [MessageController::class, 'index'])->name('views.conversations.index');
Route::get('/conversations/{id}/messages', [MessageController::class, 'single'])->name('views.conversations.single');
Route::get('/conversations/{id}/data', [MessageController::class, 'data'])->name('actions.conversations.data');
Route::get('/conversations/{id}/delete', [MessageController::class, 'destroy'])->name('actions.conversations.destroy');

Route::post('/conversations/store', [MessageController::class, 'store'])->name('actions.conversations.store');
Route::post('/conversations/{id}/send', [MessageController::class, 'send'])->name('actions.conversations.send');
