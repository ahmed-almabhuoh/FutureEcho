<?php

use App\Livewire\CapsulesComponent;
use App\Livewire\ConfirmAddingLegacyComponent;
use App\Livewire\ContributorComponent;
use App\Livewire\CreateCapsuleComponent;
use App\Livewire\IdentityVerificationComponent;
use App\Livewire\LegacyIndexComponent;
use App\Livewire\NewLegacyComponent;
use Illuminate\Support\Facades\Route;

Route::get('new-legacy', NewLegacyComponent::class)->name('legacies.new');
Route::get('legacy', LegacyIndexComponent::class)->name('legacy');
Route::get('confirm-adding-legacy', ConfirmAddingLegacyComponent::class)->name('legacy.confirmation');

Route::get('identity-verification', IdentityVerificationComponent::class)->name('identity.verification');

Route::get('create-capsule', CreateCapsuleComponent::class)->name('capsules.create');
Route::get('capsules', CapsulesComponent::class)->name('capsules.index');
Route::get('edit-capsule/{position?}/{capsule_id?}', CreateCapsuleComponent::class)->name('capsules.update');

Route::get('contributor', ContributorComponent::class)->name('contributors');
