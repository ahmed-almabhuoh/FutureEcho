<?php

namespace App\Livewire;

use App\Models\Legacy;
use App\Models\User;
use Livewire\Component;

class LegacyComponent extends Component
{
    public $statusArray = [
        'pending',
        'accepted',
        'rejected'
    ];
    public $email;
    public $status;

    public function mount()
    {
        $this->status =  'pending';
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'status' => 'required|string|in:pending',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'email' => 'legacy\'s email address',
        ];
    }

    public function addLegacy()
    {
        $this->validate();

        if (Legacy::count() == 0) {

            $user = User::where('email', $this->email)->exists();

            if ($user) {
                if ($this->email != auth()->user()->email) {
                    $legacy = Legacy::create([
                        'user_id' => auth()->id(),
                        'email' => $this->email,
                        'status' => 'pending',
                    ]);

                    session()->flash('status', $legacy ? 200 : 500);
                    session()->flash('message', $legacy ? __('Legacy added successfully') : __('Failed to add new legacy for your account, please try again later!'));

                    $this->reset(['email']);
                    $this->render();
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
        return $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.legacy-component')->title('Future Echo - Legacy');
    }
}
