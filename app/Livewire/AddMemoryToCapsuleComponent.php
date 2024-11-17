<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Memory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddMemoryToCapsuleComponent extends Component
{
    use WithFileUploads;

    public $capsule;
    public $memory_ids = [];
    public $title;
    public $medias = [];

    public function mount($capsule_id = null)
    {
        $this->capsule = Capsule::findOrFail($capsule_id);
    }

    public function rules(): array
    {
        return [];
    }

    public function newMemory()
    {
        $this->validate([
            'title' => 'required|string|min:2|max:50',
            'medias.*' => 'file|max:10240',
        ]);

        $storedFiles = [];
        foreach ($this->medias as $media) {
            $encryptedContent = Crypt::encrypt(file_get_contents($media->getRealPath()));

            $path = 'private/memories/' . uniqid() . '.' . $media->getClientOriginalExtension();
            Storage::put($path, $encryptedContent);

            $storedFiles[] = $path;
        }

        Memory::create([
            'message' => $this->title,
            'capsule_id' => $this->capsule->id,
            'user_id' => auth()->id(),
            'medias' => $storedFiles,
        ]);

        session()->flash('message', 'Memory created successfully!');
        session()->flash('status', 200);

        return redirect()->route('memories.timeline');
    }

    public function ruleAttributes(): array
    {
        return [
            'memory_ids' => 'Memories',
            'title' => 'memory title',
            'medias' => 'memory medias',
            'capsule_id' => 'capsule',
        ];
    }

    public function addMemory()
    {
        $this->validate([
            'memory_ids' => ['required', 'array', 'min:1'],
            'memory_ids.*' => ['exists:memories,id'],
        ]);

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
