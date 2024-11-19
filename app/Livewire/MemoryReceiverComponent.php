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

    public function mount(Memory $memory)
    {
        $this->memory = $memory;
        $this->users = User::all(); // Load users (fetch emails and names)
    }

    public function addReceivers()
    {
        // Save the selected receivers logic here
        $this->memory->receivers()->sync($this->receivers);
        session()->flash('success', 'Receivers added successfully!');
    }

    public function render()
    {
        return view('livewire.memory-receiver-component')
            ->title('Future Echo - Memory Receiver');
    }
}
