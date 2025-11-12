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
    
    Route::get('/contact-queries', function () {
        return view('dashboard.contact-queries');
    })->name('contact-queries');
});
