<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RegistrationComponent extends Component
{
    #[Layout('layouts.auth')]

    public $name;
    public $email;
    public $password;

    public function mount() {}

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:45',
            'email' => 'required|email|required:users,email',
            'password' => 'required|string|min:8|max:50',
        ];
    }

    public function signup()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'timezone' => getUserTimezone(request()->ip()),
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.registration-component')->title('Future Echo - Register');
    }
}
