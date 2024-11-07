<?php

namespace App\Livewire\V1;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginComponent extends Component
{
    #[Layout('v1.auth.signin')]

    public $email;
    public $password;

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, false)) {
            return redirect(route('v1.dashboard'));
        }

        session()->flush('status', 500);
        session()->flush('message', 'Wrong credentials! Please try again later.');

        return redirect(route('login'));
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function render()
    {
        return view('livewire.v1.login-component')->title('Future Echo - Login');
    }
}
