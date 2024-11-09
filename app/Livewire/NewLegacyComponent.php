<?php

namespace App\Livewire;

use App\Models\Legacy;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewLegacyComponent extends Component
{
    public $email;

    public function mount()
    {
        if (Auth::user()->legacy()->count() || auth()->user()->legacy?->status == 'accepted')
            return redirect(route('legacy.confirmation'));
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'email' => 'legacy email address'
        ];
    }

    public function newLegacy()
    {
        $this->validate();

        if (Legacy::count() == 0) {

            $user = User::where('email', $this->email)->exists();

            if ($user) {
                if ($this->email != auth()->user()->email) {

                    // session()->put('2fa-legacy-added', false);
                    $legacy = Legacy::create([
                        'user_id' => auth()->id(),
                        'email' => $this->email,
                        'status' => 'pending',
                    ]);

                    session()->flash('status', $legacy ? 200 : 500);
                    session()->flash('message', $legacy ? __('Your legacy is pending right now, you have to complete 2-step verification process') : __('Failed to add new legacy for your account, please try again later!'));

                    $this->reset(['email']);
                    // $this->render();
                    return redirect(route('legacy.confirmation'));
                } else {
                    session()->flash('status', 500);
                    session()->flash('message', __('You cannot add your account\'s email as a legacy to your account!'));

                    $this->render();
                }
            } else {
                session()->flash('status', 500);
                session()->flash('message', __('You cannot add this account as a legacy right now!'));

                $this->render();
            }
        } else {
            session()->flash('status', 500);
            session()->flash('message', __('You cannot add more one legacy to your account!'));

            $this->render();
        }
    }

    public function cancel()
    {
        return redirect(route('legacy'));
    }

    public function render()
    {
        return view('livewire.new-legacy-component')->title('Future Echo - New Legacy');
    }
}
