<?php

use App\Http\Controllers\MadingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('admin-mading', MadingController::class)->middleware('auth');

require __DIR__.'/auth.php';
