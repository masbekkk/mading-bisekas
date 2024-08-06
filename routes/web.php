<?php

use App\Http\Controllers\MadingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('mading', [MadingController::class, 'fetchData'])->name('mading.fetch');

// Group the other resource routes under the auth middleware
Route::middleware('auth')->group(function () {
    Route::resource('admin-mading', MadingController::class);
});


require __DIR__.'/auth.php';
