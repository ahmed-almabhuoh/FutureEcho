<?php

namespace App\Livewire;

use Livewire\Component;

class NewMemoryComponent extends Component
{

    public function mount() {}

    public function render()
    {
        return view('livewire.new-memory-component')->title('Future Echo - New Memory');
    }
}
