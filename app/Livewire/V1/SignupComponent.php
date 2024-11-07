<?php

namespace App\Livewire\V1;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SignupComponent extends Component
{
    #[Layout('v1.auth.signup')]

    public $fname;
    public $lname;
    public $phone;

    public function rules(): array
    {
        return [
            'fname' => 'required|string|min:2',
            'lname' => 'required|string|min:2',
            'phone' => 'required|string|min:2|unique:users,user',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'fname' =>  'First name',
            'lname' => 'Last name',
        ];
    }

    public function render()
    {
        return view('livewire.v1.signup-component')->title('Future Echo - Sign Up');
    }
}
