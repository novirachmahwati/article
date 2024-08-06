<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::post('/articles', [ArticleController::class, 'create']);
Route::get('/articles', [ArticleController::class, 'index']);