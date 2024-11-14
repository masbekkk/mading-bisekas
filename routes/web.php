<?php

use App\Http\Controllers\MadingController;
use App\Models\Mading;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('index');
});

Route::get('/tes', function () {
    return Crypt::encryptString("4NTw6KyszWgjs0zKfkqXMkeI2Y8Mt2ltkoUzVeKEMlKNXV1tVczX3zSMSxiE");
    return Str::random(60);
    // $current = Carbon::now();
    // $mading = Mading::first();
    // // return $mading->tanggal;
    // $madingTanggal = Carbon::parse($mading->tanggal);
    // $length = $madingTanggal->diffInDays($current);
    // return $length;
    // dd($length >= 3);
});

Route::get('mading', [MadingController::class, 'fetchData'])->name('mading.fetch');

// Group the other resource routes under the auth middleware
Route::middleware('auth')->group(function () {
    Route::resource('admin-mading', MadingController::class);
});


require __DIR__ . '/auth.php';
