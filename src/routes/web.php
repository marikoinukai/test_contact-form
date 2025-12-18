<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\AdminContactController;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);




Route::post('/contact', [ContactController::class, 'store']);
Route::patch('/contact/update', [ContactController::class, 'update']);
Route::delete('/contact/delete', [ContactController::class, 'destroy']);
Route::get('/contact/search', [ContactController::class, 'search']);
Route::get('/admin', [AdminContactController::class, 'index']);
Route::post('/admin', [AdminContactController::class, 'store']);
Route::patch('/admin/update', [AdminContactController::class, 'update']);
Route::delete('/admin/delete', [AdminContactController::class, 'destroy']);