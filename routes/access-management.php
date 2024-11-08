<?php

use App\Livewire\NewLegacyComponent;
use Illuminate\Support\Facades\Route;

Route::get('new-legacy', NewLegacyComponent::class)->name('legacies.new');
