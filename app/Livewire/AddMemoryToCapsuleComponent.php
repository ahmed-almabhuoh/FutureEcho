<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Memory;
use Livewire\Component;

class AddMemoryToCapsuleComponent extends Component
{
    public $capsule;
    public $memory_ids = [];

    public function mount($capsule_id = null)
    {
        $this->capsule = Capsule::findOrFail($capsule_id);
    }

    public function rules(): array
    {
        return [
            'memory_ids' => ['required', 'array', 'min:1'],
            'memory_ids.*' => ['exists:memories,id'],
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'memory_ids' => 'Memories',
        ];
    }

    public function addMemory()
    {
        $this->validate();

        Memory::whereIn('id', $this->memory_ids)->update(['capsule_id' => $this->capsule->id]);

        session()->flash('message', 'Memories added to the capsule successfully!');
        session()->flash('status', 200);
        return redirect()->route('capsules.index');
    }

    public function render()
    {
        return view('livewire.add-memory-to-capsule-component', [
            'memories' => Memory::where('user_id', auth()->id())
                ->select(['id', 'message'])
                ->get()
                ->pluck('message', 'id')
                ->toArray(),
        ])->title('Future Echo - Add Memory To Capsule');
    }
}
