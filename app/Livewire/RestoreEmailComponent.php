<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RestoreEmailComponent extends Component
{
    #[Layout('layouts.auth')]

    public $name;
    public $isValidName = false;
    public $headerTitle;
    public $headerDescription;
    public $password;
    public $userEmail;
    public $isValidPassword = false;

    public function mount()
    {
        $this->headerTitle = 'Enter your name';
        $this->headerDescription = 'Please enter your account name you remember';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function cancel()
    {
        return redirect()->route('login');
    }

    public function loginWithPassword()
    {
        return redirect()->route('login');
    }

    public function continue()
    {
        $this->validateOnly('name');

        if (User::where('name', $this->name)->exists()) {
            $this->isValidName = true;
            $this->headerTitle = 'Enter your password';
            $this->headerDescription = 'Please enter the last password you remember for your account.';
        } else {
            return redirect()->route('login')->with('message', 'We cannot recognize your account!');
        }
    }

    public function checkViaPassword()
    {
        $this->validateOnly('password');

        $users = User::where('name', $this->name)->get();
        $counter = 0;
        foreach ($users as $user) {
            if (Hash::check($this->password, $user->password)) {
                $counter++;
            }

            if ($counter == 1) {
                $this->userEmail = $user->email;
                $this->isValidPassword = true;

                $this->headerTitle = 'We get your email finally';
                $this->headerDescription = 'Your email is: ' . $this->userEmail . ', do not share it with anyone!';
            } else {
                return redirect()->route('login')->with('message', 'Sorry, we cannot restore your email address');
            }
        }
    }

    public function render()
    {
        return view('livewire.restore-email-component')->title('Future Echo - Restore Email');
    }
}
