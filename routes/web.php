<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LegacyController;
use App\Livewire\CapsuleComponent;
use App\Livewire\ContributorsComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\ForgetPasswordComponent;
use App\Livewire\LegacyComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MemoriesComponent;
use App\Livewire\RegistrationComponent;
use App\Livewire\ResetPasswordComponent;
use App\Livewire\RestoreEmailComponent;
use App\Livewire\ShowContributorComponent;
use Illuminate\Support\Facades\Route;


// Route::prefix('auth')->middleware(['guest:web'])->group(function () {
//     Route::get('login', LoginComponent::class)->name('login');
//     Route::get('reg', RegistrationComponent::class)->name('users.reg');

//     Route::get('forget-password', ForgetPasswordComponent::class)->name('users.forget-password');
//     Route::get('reset-password/{token?}', ResetPasswordComponent::class)->name('users.reset-password');
//     Route::get('restore-email', RestoreEmailComponent::class)->name('users.restore-email');
// });

// Route::prefix('u')->middleware(['auth:web'])->group(function () {

//     Route::get('/', DashboardComponent::class)->name('dashboard');

//     Route::get('memories', MemoriesComponent::class)->name('memories');
//     Route::get('legacy', LegacyComponent::class)->name('legacy');
//     Route::get('capsule', CapsuleComponent::class)->name('capsules');
//     Route::get('{capsule}/contributors', ContributorsComponent::class)->name('capsules.contributors');
//     Route::get('contributors', ShowContributorComponent::class)->name('contributors');

//     Route::post('logout', [AuthenticationController::class, 'logout'])->name('users.logout');
//     Route::get('logout', [AuthenticationController::class, 'logoutV2'])->name('users.logout.v2');
// });

// Route::get('/', function () {
//     // dd('Home');
//     // dd(file_get_contents('http://127.0.0.1:8000/storage/uploads/u121/MB98FemuSSOX0fQhq3reNC5NNkJWZHYDlLXCUmcN.pdf'));
//     // dd(Route::getCurrentRoute()->getName());
// })->name('home');

// Route::get('test', function () {
//     dd(getUserTimezone('196.10.32.155'));
// });

include 'web-v1.php';
