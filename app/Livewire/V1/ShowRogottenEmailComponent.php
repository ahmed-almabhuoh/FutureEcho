<?php

namespace App\Livewire\V1;

use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowRogottenEmailComponent extends Component
{
    #[Layout('v1.auth.forget-email')]

    public $email;

    public function mount($email)
    {
        $this->email = Crypt::decrypt($email);
    }

    public function render()
    {
        return view('livewire.v1.show-rogotten-email-component')->title('Future Echo - Show Restored Email');
    }
}
