<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/shorten', [UserController::class, 'shorten'])->middleware('auth:sanctum');
Route::get('/clicks/top', [UserController::class, 'clicks']);
Route::get('/user/urls', [UserController::class, 'urls'])->middleware('auth:sanctum');
Route::get('/search', [UserController::class, 'search']);
