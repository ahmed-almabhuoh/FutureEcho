<?php

namespace App\Livewire;

use App\Models\ResetVerifiedCredentials;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class ResetVerifiedPasswordComponent extends Component
{
    use WithFileUploads;

    #[Layout('v1.auth.forgot-password')]

    public $name;
    public $identity;

    public function mount() {}

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:45',
            'identity' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'identity' => 'identity image',
        ];
    }

    public function submit()
    {
        $this->validate();

        if ($this->identity) {
            $filePath = $this->identity->store('public/restore-requests');
            $isCreated = ResetVerifiedCredentials::create([
                'name' => $this->name,
                'file' => $filePath,
                'status' => 'pending'
            ]);

            session()->flash('message', $isCreated ? 'Request submitted successfully, we will notify you after complete our procedures' : 'Failed to apply request, try again later!');
            session()->flash('status', $isCreated ? 200 : 500);

            return redirect(route('login'));
        }
    }

    public function render()
    {
        return view('livewire.reset-verified-password-component')->title('Future Echo - Reset Verified Account');
    }
}
