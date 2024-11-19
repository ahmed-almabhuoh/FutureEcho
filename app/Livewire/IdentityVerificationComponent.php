<?php

namespace App\Livewire;

use App\Models\IdentityVerification;
use Livewire\Component;
use Livewire\WithFileUploads;

class IdentityVerificationComponent extends Component
{
    use WithFileUploads;

    public $identity;
    public $identityPreview;
    public $uploadedIdentity;

    public function mount()
    {
        $this->identityPreview = null;
        $this->uploadedIdentity = IdentityVerification::where('user_id', auth()->id())->first();
    }

    public function rules(): array
    {
        return [
            'identity' => 'required|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ];
    }

    public function updatedIdentity()
    {
        $this->validate();
    }

    public function submitRequest()
    {
        $this->validate();

        $path = $this->identity->store('identities', 'public');

        auth()->user()->identity()->create([
            'file' => $path,
        ]);

        session()->flash('message', 'Identity verification request submitted successfully.');
        session()->flash('status', 200);

        return redirect()->route('identity.verification');
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
