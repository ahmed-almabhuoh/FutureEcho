<?php

use App\Livewire\ConfirmAddingLegacyComponent;
use App\Livewire\LegacyIndexComponent;
use App\Livewire\NewLegacyComponent;
use Illuminate\Support\Facades\Route;

Route::get('new-legacy', NewLegacyComponent::class)->name('legacies.new');
Route::get('legacy', LegacyIndexComponent::class)->name('legacy');
Route::get('confirm-adding-legacy', ConfirmAddingLegacyComponent::class)->name('legacy.confirmation');
