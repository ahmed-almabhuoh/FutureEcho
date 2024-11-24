<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Memory;
use Livewire\Component;

class MemoryReceiverComponent extends Component
{
    public $memory;
    public $receivers = [];
    public $users = [];

    protected $listeners = ['select2Updated'];

    public function select2Updated($receivers)
    {
        // dd($receivers);
        $this->receivers[] = $receivers;
    }

    public function mount($memory)
    {
        $this->memory = Memory::withoutGlobalScopes()->where('id', $memory)->first();
        $this->users = User::all();
    }

    public function addReceivers()
    {
        // Debugging the selected receivers
        dd($this->receivers);

        // Assuming receivers is an array of emails, you can sync them with the memory
        $this->memory->receivers()->sync($this->receivers);

        // Flash message
        session()->flash('message', 'Receivers added successfully!');
        session()->flash('status', 500);
    }

    public function render()
    {
        // $this->dispatch('select2Updated'); // Dispatch event to trigger select2 re-initialization
        return view('livewire.memory-receiver-component')->title('Future Echo - Receivers');
    }
}
