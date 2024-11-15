<?php

namespace App\Livewire;

use App\Models\Memory;
use Livewire\Component;

class MemoryReceiverComponent extends Component
{
    public $memory;

    public function mount(Memory $memory) {}

    public function render()
    {
        return view('livewire.memory-receiver-component')->title('Future Echo - Memory Receiver');
    }
}
