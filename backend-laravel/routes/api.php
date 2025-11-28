<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('books', BookController::class);

    Route::get('/borrow', [BorrowController::class, 'index']);
    Route::post('/borrow/{book}', [BorrowController::class, 'borrow']);
    Route::post('/return/{id}', [BorrowController::class, 'returnBook']);
});
