<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class IdentityVerificationComponent extends Component
{
    use WithFileUploads;

    public $identity;

    public function mount() {}

    public function rules(): array
    {
        return [
            'identity' => '',
        ];
    }

    public function ruleAttribute(): array
    {
        return [
            'identity' => 'identity image',
        ];
    }

    public function submitRequest()
    {
        $this->validate();
    }

    public function cancel()
    {
        return redirect(route('v1.dashboard'));
    }

    public function render()
    {
        return view('livewire.identity-verification-component')->title('Future Echo - Identity Verification');
    }
}
