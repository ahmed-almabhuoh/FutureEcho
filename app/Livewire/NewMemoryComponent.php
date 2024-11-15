<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Memory; // Ensure you have a model for memories
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewMemoryComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $medias = [];
    public $capsule_id;

    public function mount() {}

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:50',
            'capsule_id' => 'nullable|integer|exists:capsules,id',
            'medias.*' => 'file|max:10240',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'title' => 'memory title',
            'medias' => 'memory medias',
            'capsule_id' => 'capsule',
        ];
    }

    public function newMemory()
    {
        $this->validate();

        $storedFiles = [];
        foreach ($this->medias as $media) {
            $encryptedContent = Crypt::encrypt(file_get_contents($media->getRealPath()));

            $path = 'private/memories/' . uniqid() . '.' . $media->getClientOriginalExtension();
            Storage::put($path, $encryptedContent);

            $storedFiles[] = $path;
        }

        Memory::create([
            'message' => $this->title,
            'capsule_id' => $this->capsule_id,
            'user_id' => auth()->id(),
            'medias' => $storedFiles,
        ]);

        session()->flash('message', 'Memory created successfully!');
        session()->flash('status', 200);

        return redirect()->route('memories.timeline');
    }

    public function cancel()
    {
        return redirect()->route('memories');
    }

    public function render()
    {
        return view('livewire.new-memory-component', [
            'capsules' => Capsule::where('user_id', auth()->id())->select(['id', 'title'])->get()->pluck('title', 'id')->toArray(),
            'memories' => Memory::where('user_id', auth()->id())->get(),
        ])->title('Future Echo - New Memory');
    }
}
