<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ParentDashboardController;
use App\Http\Controllers\Api\V1\StoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/stories', [StoryController::class, 'index']);
Route::get('/stories/{story:slug}', [StoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/stories/{story}/progress', [StoryController::class, 'updateProgress']);
    Route::post('/stories/{story}/quiz-submit', [StoryController::class, 'submitQuiz']);

    Route::get('/parent/dashboard', [ParentDashboardController::class, 'index']);
    Route::get('/parent/children/{childProfile}', [ParentDashboardController::class, 'showChildProfile']);
});

Route::get('/health', function (Request $request) {
    return response()->json([
        'status' => 'ok',
        'environment' => app()->environment(),
        'timestamp' => now()->toIso8601String(),
    ]);
});
