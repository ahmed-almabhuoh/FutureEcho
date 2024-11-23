<?php

namespace App\Livewire;

use App\Models\TwoFA;
use App\Models\User;
use App\Notifications\LegacyAddedNotification;
use App\Notifications\SendPassKeyNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

class ConfirmAddingLegacyComponent extends Component
{
    #[Layout('v1.auth.forgot-password')]

    public $twoFA;

    public function mount()
    {
        $user = auth()->user();
        if ($user->legacy?->status == 'accepted')
            return redirect(route('legacy'));
    }

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

        $user = Auth::user();
        $legacy = $user->legacy;
        $legacyUser = User::where('email', $legacy->email)->first();
        $code = TwoFA::where('user_id', $legacyUser->id)->first();

        if (Hash::check($this->twoFA, $code->code)) {

            // Pass-key here
            $legacy->status = 'accepted';
            $passKey = Str::random(35);
            $legacy->pass_key = Hash::make($passKey);
            info($passKey);
            $isSaved = $legacy->save();

            $user->notify(new SendPassKeyNotification($user, $passKey));

            session()->flash('message', $isSaved ? 'Legacy added successfully' : 'Failed to add legacy, please tru again later!');
            session()->flash('status', $isSaved ? 200 : 500);

            return redirect(route('legacy'));
        } else {
            session()->flash('message', 'Incorrect Input!');
            session()->flash('status', 500);

            $this->render();
        }
    }

    public function resend2FACode()
    {
        $legacy = Auth::user()->legacy;
        $legacyUser = User::where('email', $legacy->email)->first();
        $twoFACode = generate2FA($legacyUser->id);

        if ($twoFACode) {
            $legacyUser->notify(new LegacyAddedNotification($legacyUser, $twoFACode));

            session()->flash('message', '2FA Code Resent Successfully');
            session()->flash('status', 200);

            $this->render();
        } else {
            session()->flash('message', 'Something went wrong, please try again later!');
            session()->flash('status', 500);

            $this->render();
        }
    }

    public function render()
    {
        return view('livewire.confirm-adding-legacy-component')->title('Future Echo - Confirm Adding Legacy');
    }
}
