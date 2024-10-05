<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginComponent extends Component
{
    #[Layout('layouts.auth')]

    public $email;
    public $password;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function mount() {}

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, false)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('message', 'Wrong credentials! try again later.');
        }
    }

    public function render()
    {
        return view('livewire.login-component')->title('Future Echo - Login');
    }
}
