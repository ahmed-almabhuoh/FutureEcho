<?php

// use Illuminate\Routing\Route;

use App\Http\Controllers\v1\AuthController;
use App\Livewire\ResetPasswordComponent;
use App\Livewire\RestoreEmailComponent;
use App\Livewire\V1\DashboardComponent;
use App\Livewire\V1\ForgetPasswordComponent;
use App\Livewire\V1\LoginComponent;
use App\Livewire\V1\ShowRogottenEmailComponent;
use App\Livewire\V1\SignupComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware(['guest:web'])->group(function () {
    Route::get('reg', SignupComponent::class)->name('v1.signup');
    Route::post('reg', [AuthController::class, 'registration'])->name('v1.registration');
    Route::get('forget-password', ForgetPasswordComponent::class)->name('forget.password');
    Route::get('reset-password/{token?}', ResetPasswordComponent::class)->name('reset.password');
    Route::get('restore-email', RestoreEmailComponent::class)->name('forget.email');
    Route::get('show-forgotten-email/{email}', ShowRogottenEmailComponent::class)->name('show.forgotten.email');
    Route::get('login', LoginComponent::class)->name('login');
});

Route::prefix('dashboard')->middleware(['auth:web'])->group(function () {
    Route::get('', DashboardComponent::class)->name('v1.dashboard');
});
