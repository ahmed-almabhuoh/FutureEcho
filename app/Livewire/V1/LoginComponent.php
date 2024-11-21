<?php

namespace App\Livewire\V1;

use App\Models\User;
use App\Notifications\NewLoginNotification;
use Carbon\Carbon;
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

        $user = User::withTrashed()->where('email', '=', $credentials['email'])->first();
        // Here should add a new condition, to check if the user has 30 days from delete action {Also you have to add a cron job to force delete the soft-deleted users}
        if (!is_null($user->deleted_at)) {
            $user->deleted_at = null;
            $user->save();
        }


        if (Auth::attempt($credentials, false)) {

            // Prepare to 2fa
            session()->put('2fa-authenticated', false);
            $code = generate2FA(auth()->id());

            // Should Be Deleted
            info($code);

            $user = Auth::user();
            $user->notify(new NewLoginNotification($code, $user->name));
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
