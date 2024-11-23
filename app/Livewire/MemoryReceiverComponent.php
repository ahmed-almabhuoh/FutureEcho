<?php

namespace App\Livewire;

use App\Models\User; // Assuming you're using a User model
use App\Models\Memory;
use Livewire\Component;

class MemoryReceiverComponent extends Component
{
    public $memory;
    public $receivers = []; // Stores selected user IDs
    public $users = [];     // List of users to display in the dropdown

    public function mount($memory)
    {
        $this->memory = Memory::withoutGlobalScopes()->where('id', $memory)->first();
        $this->users = User::all(); // Load users (fetch emails and names)
    }

    public function addReceivers()
    {
        // Sync the selected receivers to the memory's receivers relationship
        $this->memory->receivers()->sync($this->receivers);
        session()->flash('message', 'Receivers added successfully!');
        session()->flash('status', 500);
    }

    public function render()
    {
        return view('livewire.memory-receiver-component')->title('Future Echo - Receivers');
    }
}
