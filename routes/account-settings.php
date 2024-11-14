<?php

use App\Livewire\ChangePasswordComponent;
use App\Livewire\DeleteAccountComponent;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->group(function () {
    Route::get('change-password', ChangePasswordComponent::class)->name('change.password');
    Route::get('delete-account', DeleteAccountComponent::class)->name('delete.account');
});
