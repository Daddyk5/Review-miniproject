<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;


// Public API routes (no authentication required)
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);
Route::get('/movies/{movie}/reviews', [ReviewController::class, 'index']);

// Protected API routes (require authentication, e.g., Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
   
        // Movies CRUD
    Route::post('/movies', [MovieController::class, 'store']);
    Route::put('/movies/{movie}', [MovieController::class, 'update']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);

    // Reviews CRUD
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

    // ✅ Movie API Routes

});
