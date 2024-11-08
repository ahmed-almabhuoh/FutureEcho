<?php

namespace App\Livewire\V1;

use App\Models\TwoFA;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Enter2FAComponent extends Component
{
    #[Layout('v1.auth.forgot-password')]

    public $twoFA;

    public function mount() {}

    public function rules(): array
    {
        return [
            'twoFA' => 'required|string|min:1',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'twoFA' => '2FA',
        ];
    }

    public function check()
    {
        $this->validate();

        if ($twoFACode = TwoFA::where('user_id', auth()->id())->first()) {
            if (Hash::check($this->twoFA, $twoFACode->code)) {

                TwoFA::where('user_id', auth()->id())->delete();

                session()->put('2fa-authenticated', true);
                return redirect(route('v1.dashboard'));
            }
        }

        session()->flash('message', 'Incorrect Input!');
        session()->flash('status', 500);

        $this->render();
    }

    public function render()
    {
        return view('livewire.v1.enter2-f-a-component')->title('Future Echo - Enter 2FA Code');
    }
}
