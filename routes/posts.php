<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('',[PostController::class,'getAll'])->name('Статьи|Получить все статьи');
Route::post('',[PostController::class,'store'])->name('Статьи|Создать статью');
Route::patch('/{post}/',[PostController::class,'like'])->name('Статьи|Поставить или убрать лайк');
Route::get('/{post}/likes',[PostController::class,'getLikes'])->name('Статьи|Поставить или убрать лайк');
Route::get('/categories',[PostController::class,'getCategories'])->name('Статьи|Просмотреть доступные категории');
