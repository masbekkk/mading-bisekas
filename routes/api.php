<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ApprovalController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\MadingController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', [AuthController::class, 'login'])->name('auth-login');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::put('mading/{id}', [MadingController::class, 'update'])->name('mading-update');
    Route::delete('mading/{id}', [MadingController::class, 'destory'])->name('mading-destroy');
    Route::get('customers', [AdminController::class, 'getCustomers'])->name('admin-get-customers');
});

Route::middleware(['auth:sanctum', 'role:approver'])->group(function () {
    Route::get('approval', [ApprovalController::class, 'index'])->name('approval-index');
    Route::get('approval/approve/{id}', [ApprovalController::class, 'approve'])->name('approval-approve');
    Route::get('approval/reject/{id}', [ApprovalController::class, 'reject'])->name('approval-reject');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth-logout');

    Route::get('mading', [MadingController::class, 'index'])->name('mading-index');
    Route::get('mading/{id}', [MadingController::class, 'show'])->name('mading-show');

    Route::group(['prefix' => 'user'], function () {
        Route::get('me', [UserController::class, 'me'])->name('user-me');
        Route::put('update', [UserController::class, 'update'])->name('user-update');
    });

    Route::group(['prefix' => 'mading/comment'], function () {
        Route::get('{mading}', [CommentController::class, 'show'])->name('mading-comment-show');
        Route::post('{mading}', [CommentController::class, 'store'])->name('mading-comment-store');
        Route::delete('delete/{comment}', [CommentController::class, 'destroy'])->name('mading-comment-destroy');
    });

    Route::group(['prefix' => 'conversations', 'middleware' => 'role:admin,customer'], function () {
        Route::get('/', [ChatController::class, 'getConversations'])->name('conversations-index');
    });

    Route::group(['prefix' => 'chat', 'middleware' => 'role:admin,customer'], function () {
        Route::get('{conversation}/messages', [ChatController::class, 'index'])->name('chat-show');
        Route::post('messages', [ChatController::class, 'store'])->name('chat-store');
    });
});
