<?php

namespace App\Livewire;

use App\Models\IdentityVerification;
use Livewire\Component;

class IdentityViewComponent extends Component
{
    public $uploadedIdentity;

    public function reload()
    {
        $this->uploadedIdentity = IdentityVerification::where('user_id', auth()->id())->first();
    }

    public function render()
    {
        return view('livewire.identity-view-component');
    }
}
