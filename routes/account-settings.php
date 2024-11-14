<?php

use App\Livewire\ChangePasswordComponent;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->group(function () {
    Route::get('change-password', ChangePasswordComponent::class)->name('change.password');
});
