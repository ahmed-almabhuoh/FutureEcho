<?php

namespace App\Livewire;

use App\Models\Token;
use App\Models\User;
use App\Notifications\PasswordRestoredNotification;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ResetPasswordComponent extends Component
{
    #[Layout('v1.auth.forgot-password')]

    public $password;
    public $password_confirmation;
    public $token;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function rules(): array
    {
        return [
            'password' => 'required|string|min:8|max:45|confirmed',
            'password_confirmation' => 'required|string',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'password' => 'new password',
            'password_confirmation' => 'password confirmation',
        ];
    }

    public function resetPassword()
    {
        $this->validate();

        if (! is_string($this->token) && count($this->token) < 80)
            return redirect()->route('login');

        $token = Token::where('token', $this->token)->first();

        if ($token) {
            $user = User::where('id', $token->user_id)->first();

            if ($user) {
                $user->password = Hash::make($this->password);
                $user->save();

                DB::table('tokens')->where('token', $this->token)->delete();

                $user->notify(new PasswordRestoredNotification($user->name));

                session()->flash('message', 'Password restore successfully');
                session()->flash('status', 200);

                return redirect()->route('login');
            } else {

                session()->flash('message', 'We cannot reset your password!');
                session()->flash('status', 500);

                return redirect()->route('login');
            }
        } else {

            session()->flash('message', 'We cannot reset your password!');
            session()->flash('status', 500);

            return redirect()->route('login');
        }
    }

    public function cancel()
    {
        return $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.reset-password-component')->title('Future Echo - Reset Password');
    }
}