<?php

use App\Http\Controllers\AuthenticationController;
use App\Livewire\ForgetPasswordComponent;
use App\Livewire\LoginComponent;
use App\Livewire\RegistrationComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::get('login', LoginComponent::class)->name('users.login');
    Route::get('reg', RegistrationComponent::class)->name('users.reg');

    Route::get('forget-password', ForgetPasswordComponent::class)->name('users.forget-password');
});

Route::prefix('u')->middleware(['auth:web'])->group(function () {

    Route::get('/', function () {
        dd('Dasboard');
    })->name('dashboard');


    Route::post('logout', [AuthenticationController::class, 'logout'])->name('users.logout');
});

Route::get('/', function () {
    dd('Home');
})->name('home');

Route::get('test', function () {
    dd(getUserTimezone('196.10.32.155'));
});
