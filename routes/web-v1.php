<?php

// use Illuminate\Routing\Route;

use App\Http\Controllers\v1\AuthController;
use App\Livewire\ResetPasswordComponent;
use App\Livewire\V1\DashboardComponent;
use App\Livewire\V1\ForgetPasswordComponent;
use App\Livewire\V1\LoginComponent;
use App\Livewire\V1\SignupComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware(['guest:web'])->group(function () {
    Route::get('reg', SignupComponent::class)->name('v1.signup');
    Route::post('reg', [AuthController::class, 'registration'])->name('v1.registration');
    Route::get('forget-password', ForgetPasswordComponent::class)->name('forget.password');
    Route::get('reset-password/{token?}', ResetPasswordComponent::class)->name('reset.password');
    Route::get('login', LoginComponent::class)->name('login');
});

Route::prefix('v1')->middleware(['auth:web'])->group(function () {
    Route::get('', DashboardComponent::class)->name('v1.dashboard');
});
