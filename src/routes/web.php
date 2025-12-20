<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminController;

// use App\Http\Controllers\AdminContactController;

// お問い合わせ関連
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);
// Route::get('/register', [RegisterController::class, 'index']);
// Route::post('/register', [RegisterController::class, 'store']);
// Route::get('/login', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'store']);
// Route::post('/logout', [LoginController::class, 'destroy']);


// 管理者ログイン後の機能
Route::middleware('auth')->group(function () {
    // 管理画面のトップ（一覧表示）
    Route::get('/admin', [AdminController::class, 'index']);

    // 検索機能（これを追加！）
    Route::get('/admin/search', [AdminController::class, 'search']);

    // 削除処理
    Route::post('/admin/delete', [AdminController::class, 'destroy']);

    Route::get('/admin/export', [AdminController::class, 'export']);
});


// Route::post('/contact', [ContactController::class, 'store']);
// Route::patch('/contact/update', [ContactController::class, 'update']);
// Route::delete('/contact/delete', [ContactController::class, 'destroy']);
// Route::get('/contact/search', [ContactController::class, 'search']);
// Route::get('/admin', [AdminContactController::class, 'index']);
// Route::post('/admin', [AdminContactController::class, 'store']);
// Route::patch('/admin/update', [AdminContactController::class, 'update']);
// Route::delete('/admin/delete', [AdminContactController::class, 'destroy']);