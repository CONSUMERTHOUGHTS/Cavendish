<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('websites', [WebsiteController::class, 'store']);
    Route::post('websites/{website}/vote', [WebsiteController::class, 'vote']);
    Route::delete('websites/{website}/vote', [WebsiteController::class, 'unvote']);
    Route::middleware('can:admin')->group(function () {
        Route::delete('websites/{website}', [AdminController::class, 'destroy']);
    });
});

Route::get('websites', [WebsiteController::class, 'index']);
Route::get('websites/search', [WebsiteController::class, 'search']);