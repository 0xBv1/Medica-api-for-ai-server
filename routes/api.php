<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// إرسال رابط التحقق
Route::middleware('auth:sanctum')->post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return response()->json(['message' => 'Verification link sent']);
})->name('verification.send');

// التحقق من الإيميل بعد الضغط على الرابط
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return response()->json(['message' => 'Email verified']);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// التحقق من حالة التحقق
Route::get('/email/verify', function (Request $request) {
    return $request->user()->hasVerifiedEmail()
        ? response()->json(['verified' => true])
        : response()->json(['verified' => false]);
})->middleware('auth:sanctum')->name('verification.check');