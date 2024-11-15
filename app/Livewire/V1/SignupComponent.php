<?php

namespace App\Livewire\V1;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

class SignupComponent extends Component
{
    #[Layout('v1.auth.signup')]

    public $name;
    public $phone;
    public $email;
    public $timezone;

    public $personalInfo;
    public $accountSettings;

    public function mount()
    {
        $this->personalInfo = true;
        $this->accountSettings = false;
    }

    public function previous()
    {
        $this->personalInfo != $this->personalInfo;
        $this->accountSettings != $this->accountSettings;
    }

    public function nextStep()
    {
        if ($this->personalInfo) {
            $this->validate([
                'name' => 'required|string|min:2|max:45',
                'phone' => 'nullable|string|min:2|unique:users,phone',
                'email' => 'required|email|unique:users,email',
            ]);

            $this->personalInfo = false;
            $this->accountSettings = true;
        } else if ($this->accountSettings) {
            $this->validate([
                'timezone' => 'required|string',
            ]);

            $this->accountSettings = false;
            // $this->personalInfo = false;
        }
    }

    public function reg()
    {
        $this->validate();

        $password = Str::random(8);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_admin' => false,
            'password' => Hash::make($password)
        ]);

        // Should notify the user with the new password & send the 2FA code
        info($password);

        if ($user)
            Auth::login($user);

        session()->flash('status', $user ? 200 : 500);
        session()->flash('message', $user ? __('Registration completed') : __('Failed to complete register!'));

        return $user ? redirect()->route('v1.dashboard') : redirect()->route('v1.registration');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:45',
            'phone' => 'nullable|string|min:2|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'timezone' => 'required|string',
        ];
    }

    public function ruleAttributes(): array
    {
        return [];
    }

    public function render()
    {
        return view('livewire.v1.signup-component')->title('Future Echo - Sign Up');
    }
}
