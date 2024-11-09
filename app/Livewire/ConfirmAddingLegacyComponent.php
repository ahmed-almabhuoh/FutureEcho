<?php

namespace App\Livewire;

use App\Models\TwoFA;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ConfirmAddingLegacyComponent extends Component
{
    #[Layout('v1.auth.forgot-password')]

    public $twoFA;

    public function mount() {}

    public function rules(): array
    {
        return [
            'twoFA' => 'required|string|min:2',
        ];
    }

    public function ruleAttributes(): array
    {
        return  [
            'twoFA' => '2-fa code',
        ];
    }

    public function confirm()
    {
        $this->validate();

        $legacy = Auth::user()->legacy;
        $legacyUser = User::where('email', $legacy->email)->first();
        $code = TwoFA::where('user_id', $legacyUser->id)->first();

        if (Hash::check($this->twoFA, $code->code)) {
            $legacy->status = 'accepted';
            $isSaved = $legacy->save();

            session()->flash('message', $isSaved ? 'Legacy added successfully' : 'Failed to add legacy, please tru again later!');
            session()->flash('status', $isSaved ? 200 : 500);

            return redirect(route('legacy'));
        }else {
            session()->flash('message', 'Incorrect Input!');
            session()->flash('status', 500);

            $this->render();
        }
    }

    public function render()
    {
        return view('livewire.confirm-adding-legacy-component')->title('Future Echo - Confirm Adding Legacy');
    }
}
