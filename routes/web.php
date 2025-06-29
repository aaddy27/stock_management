<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/stock/add', [StockController::class, 'addForm'])->name('stock.add');
Route::post('/stock/add', [StockController::class, 'store']);
Route::get('/stock/reduce', [StockController::class, 'reduceForm'])->name('stock.reduce');
Route::post('/stock/reduce', [StockController::class, 'reduce']);
Route::get('/stock/allot', [StockController::class, 'allotForm'])->name('stock.allot');
Route::post('/stock/allot', [StockController::class, 'allot']);
Route::get('/stock/restock', [StockController::class, 'restockForm'])->name('stock.restock');
Route::post('/stock/restock', [StockController::class, 'restock']);
Route::get('/stock/report', [StockController::class, 'stockReport'])->name('stock.report');
Route::get('/stock/history', [StockController::class, 'stockHistory'])->name('stock.history');
Route::get('/stock/history/{id}', [StockController::class, 'stockHistoryDetail'])->name('stock.history.detail');
Route::post('/stock/return/{log_id}', [StockController::class, 'returnStock'])->name('stock.return');
Route::get('/stock/return-history', [StockController::class, 'returnHistory'])->name('stock.return.history');
