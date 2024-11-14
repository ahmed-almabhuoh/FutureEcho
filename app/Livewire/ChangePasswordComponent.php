<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ChangePasswordComponent extends Component
{
    public $old_password;
    public $password;
    public $password_confirmation;

    public function mount() {}

    public function rules(): array
    {
        return [
            'old_password' => 'required|string',
            'password' => ['required', 'string', 'min:8', 'max:45', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'old_password' => 'current password',
        ];
    }

    public function cancel() {}

    public function changePassword()
    {
        $this->validate();

        $user = auth()->user();

        if (Hash::check($this->old_password, $user->password)) {
            $user->password = Hash::make($this->password);
            $isUpdated = $user->save();

            session()->flash('message', $isUpdated ? 'Password Changed' :  'Failed to change password, please try again later!');
            session()->flash('status',  $isUpdated  ? 200 : 500);

            $this->render();
            $this->reset();
            return;
        } else {
            session()->flash('message', 'Incorrect Credentials');
            session()->flash('status', 500);

            $this->render();
            return;
        }
    }

    public function render()
    {
        return view('livewire.change-password-component')->title('Future Echo - Change Password');
    }
}
