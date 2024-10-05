<?php

use App\Http\Controllers\AuthenticationController;
use App\Livewire\LoginComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::get('login', LoginComponent::class)->name('users.login');
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
