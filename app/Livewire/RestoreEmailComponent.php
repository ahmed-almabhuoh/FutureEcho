<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RestoreEmailComponent extends Component
{
    #[Layout('v1.auth.forget-email')]

    public $name;
    public $showLastPasswordInputs;
    public $lastPassword;

    public function mount()
    {
        $this->showLastPasswordInputs = false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:45',
            'lastPassword' => 'required|string',
        ];
    }

    public function forgetEmail()
    {
        $this->validateOnly('name');
        $this->showLastPasswordInputs = true;
    }

    public function ruleAttributes(): array
    {
        return [
            'name' => 'account name',
            'lastPassword' => 'last password',
        ];
    }

    public function submitForgetEmail()
    {
        $this->validate();

        $users = User::where('name', $this->name)->select(['email', 'password'])->get();

        foreach ($users as $user) {
            if (Hash::check($this->lastPassword, $user->password)) {
                return redirect(route('show.forgotten.email', ['email' => Crypt::encrypt($user->email)]));
            }
        }

        session()->flash('message', 'We cannot recognize your account, please try again!');
        session()->flash('status', 500);

        return redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.restore-email-component')->title('Future Echo - Forgot Email');
    }
}
