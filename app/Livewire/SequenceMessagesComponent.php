<?php

namespace App\Livewire;

use App\Models\Memory;
use App\Models\Message;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class SequenceMessagesComponent extends Component
{
    public $memory;
    public $message;
    public $before;
    public $toBeDeleted;

    public function mount(Memory $memory) {}

    public function rules(): array
    {
        return [
            'message' => 'required|string|min:1|max:50',
            'before' => 'required|int|min:1|max:360',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'message' => 'sequences message',
            'before' => 'days before',
        ];
    }

    public function newMessage()
    {
        $this->validate();

        $msg = Message::create([
            'before' => $this->before,
            'message' => $this->message,
            'memory_id' => $this->memory->id,
            'capsule_id' => $this->memory?->capsule?->id,
        ]);

        session()->flash('message', $msg ? 'Message added successfully' : 'Failed to add message, please try again later!');
        session()->flash('status', $msg ? 200 : 500);

        $this->render();
        $this->resetExcept(['memory']);
    }

    public function cancel()
    {
        return redirect(route('memories'));
    }

    public function setToBeDeleted($id)
    {
        $this->toBeDeleted = Crypt::decrypt($id);
    }

    public function delete()
    {
        Message::where([
            ['memory_id', '=', $this->memory->id],
            ['id', '=', $this->toBeDeleted],
        ])->delete();

        // $this->render();
        // $this->resetExcept(['memory']);
        return redirect(route('memories.seq.msgs', $this->memory->id));
    }

    public function render()
    {
        return view('livewire.sequence-messages-component', [
            'msgs' => Message::where('memory_id', $this->memory->id)->get(),
        ])->title('Future Echo - Memory Sequence Messages');
    }
}
