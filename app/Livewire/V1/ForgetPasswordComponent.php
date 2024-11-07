<?php

namespace App\Livewire\V1;

use App\Models\User;
use App\Notifications\ChangeUserPasswordNotification;
use App\Notifications\PasswordRestoredNotification;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgetPasswordComponent extends Component
{
    #[Layout('v1.auth.forgot-password')]

    public $email;

    public function mount() {}

    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'email' => 'email address',
        ];
    }

    public function forgetPassword()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        if ($user && ($token = generateToken($user->id))) {
            $user->notify(new ChangeUserPasswordNotification($user->name, $token));
        }

        return redirect(route('login'))
            ->with('message', 'Process completed, check your inbox to restore your password')
            ->with('status', 200);
    }

    public function render()
    {
        return view('livewire.v1.forget-password-component')->title('Future Echo - Forget Password');
    }
}
