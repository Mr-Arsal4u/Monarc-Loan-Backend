<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactQueryController;

// Public API routes (no authentication required for contact form)
Route::post('/contact-queries', [ContactQueryController::class, 'store']);

// Protected API routes (for dashboard/admin - add auth middleware as needed)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/contact-queries', [ContactQueryController::class, 'index']);
    Route::get('/contact-queries/{id}', [ContactQueryController::class, 'show']);
    Route::post('/contact-queries/{id}/mark-read', [ContactQueryController::class, 'markAsRead']);
    Route::post('/contact-queries/{id}/archive', [ContactQueryController::class, 'archive']);
    Route::delete('/contact-queries/{id}', [ContactQueryController::class, 'destroy']);
});

