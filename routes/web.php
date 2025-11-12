<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Routes
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('index');
    
    Route::get('/loan-applications', function () {
        return view('dashboard.loan-applications');
    })->name('loan-applications');
    
    Route::get('/users', function () {
        return view('dashboard.users');
    })->name('users');
    
    Route::get('/contact-queries', [App\Http\Controllers\ContactQueryController::class, 'index'])->name('contact-queries');
    Route::match(['get', 'post'], '/contact-queries/{id}', [App\Http\Controllers\ContactQueryController::class, 'show'])->name('contact-queries.show');
});
