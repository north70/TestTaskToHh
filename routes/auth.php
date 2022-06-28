<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class,'login'])->name("Auth|Вход");
Route::post('register', [AuthController::class,'register'])->name("Auth|Регистрация");
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class,'logout'])->name("Auth|Выход");
    Route::post('refresh', [AuthController::class,'refresh'])->name("Auth|Обновить токен");
    Route::post('me', [AuthController::class,'me'])->name("Auth|Авторизированный пользователь");
});

