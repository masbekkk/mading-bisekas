<?php

use App\Http\Controllers\MadingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('admin-mading', [MadingController::class, 'index'])->name('admin-mading.index');

// Group the other resource routes under the auth middleware
Route::middleware('auth')->group(function () {
    Route::resource('admin-mading', MadingController::class)->except(['index']);
});


require __DIR__.'/auth.php';
