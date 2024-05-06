<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('esqueceu-sua-senha', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('esqueceu-sua-senha', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('nova-senha/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('nova-senha', [NewPasswordController::class, 'store'])
    ->name('password.store');
});

Route::group(['middleware' => ['can:create student']], function () {
    Route::get('registro', [RegisteredUserController::class, 'create'])
        ->name('registro');
    Route::post('registro', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('verificar-e-mail', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verificar-e-mail/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('verificar-e-mail/notificacao-de-verificacao', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirmar-senha', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirmar-senha', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('sair', [AuthenticatedSessionController::class, 'destroy'])
        ->name('sair');
});
