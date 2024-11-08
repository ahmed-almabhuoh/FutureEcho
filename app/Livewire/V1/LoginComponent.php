<?php

namespace App\Livewire\V1;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // $user = User::where([
        //     ['email', '=', $this->email],
        // ])->select(['password', 'id'])->first();

        // if (Hash::check($this->password, $user->password)) {
        //     generate2FA($user->id);
        // }

        if (Auth::attempt($credentials, false)) {

            // Prepare to 2fa
            session()->put('2fa-authenticated', false);
            $code = generate2FA(auth()->id());
            info($code);
            if ($code)
                return redirect()->route('enter.2fa');

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
