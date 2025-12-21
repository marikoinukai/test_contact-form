<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminController;


// お問い合わせ関連
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

// 管理者ログイン後の機能
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/reset', [AdminController::class, 'reset']);
    Route::post('/delete', [AdminController::class, 'destroy']);
    Route::get('/export', [AdminController::class, 'export']);
});
