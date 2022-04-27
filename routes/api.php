<?php

use App\Http\Controllers\Ask\AskApiDataContoller;
use App\Http\Controllers\Ask\AskAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get user token
Route::get('/getToken', [AskAuthController::class, 'encryptToken']);
Route::get('/getDcryptToken/{token}', [AskAuthController::class, 'dcryptToken']);

// Data Category Coahing API
Route::get('/category-coaching', [AskApiDataContoller::class, 'getDataCategoriesCoaching']);

// Data Coach Room API
Route::post('/coach-room', [AskApiDataContoller::class, 'createRoom']);