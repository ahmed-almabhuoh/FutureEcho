<?php

namespace App\Livewire;

use App\Models\User;
use App\Notifications\ChangeUserPasswordNotification;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgetPasswordComponent extends Component
{
    #[Layout('layouts.auth')]

    public $email;

    public function rules(): array
    {
        return [
            // If the email is not exists, we will not notify the user and will not send the email
            'email' => 'required|email',
        ];
    }

    public function cancel()
    {
        return redirect()->route('login');
    }

    public function submit()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $user->notify(new ChangeUserPasswordNotification($user->name, generateToken($user->id)));
        }

        return redirect()->route('login')->with('message', 'Check your inbox to reset you password!');
    }


    public function render()
    {
        return view('livewire.forget-password-component')->title('Future Echo - Forget Password');
    }
}
