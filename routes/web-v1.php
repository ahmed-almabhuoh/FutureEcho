<?php


// use Illuminate\Routing\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Middleware\Check2FAMiddelware;
use App\Livewire\ResetPasswordComponent;
use App\Livewire\RestoreEmailComponent;
use App\Livewire\V1\DashboardComponent;
use App\Livewire\V1\Enter2FAComponent;
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

Route::prefix('dashboard')->middleware(['auth:web', Check2FAMiddelware::class])->group(function () {
    Route::get('enter-2fa', Enter2FAComponent::class)->name('enter.2fa')->withoutMiddleware(Check2FAMiddelware::class);

    Route::get('', DashboardComponent::class)->name('v1.dashboard');

    include 'access-management.php';

    Route::post('logout', [AuthenticationController::class, 'logout'])->withoutMiddleware(Check2FAMiddelware::class)->name('logout');
});
