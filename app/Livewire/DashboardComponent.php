<?php

namespace App\Livewire;

use App\Models\Memory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class DashboardComponent extends Component
{
    use WithFileUploads;

    #[Layout('layouts.dashboard')]

    public $options = ['images', 'documents', 'videos', 'other'];
    public $file;
    public $title;
    public $memories;

    // Random value
    public $randomValue;
    public $minRandomValue = 10;

    public function mount()
    {
        $this->memories = Memory::get();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:50',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'title' => 'media name',
        ];
    }

    public function uploadFile()
    {
        $this->validate();

        $filePath = [];
        $memory = null;
        if (count($this->file)) {
            foreach ($this->file as $uploadedFile) {
                $filePath[] = $uploadedFile->store('uploads/u' . auth()->id(), 'public');
            }
        }

        if (count($filePath)) {
            $memory = Memory::create([
                'message' => $this->title,
                'medias' => json_encode($filePath),
                'user_id' => auth()->id(),
            ]);
        }

        session()->flash('status', $memory ? 200 : 500);
        session()->flash('message', $memory ? __('Memory added successfully') : __('Failed to add memory, please try again later!'));

        $this->reset(['file', 'title']);
    }

    public function goToAttachment($id)
    {
        $memory = Memory::findOrFail($id);
        $mediaUrl = json_decode($memory->medias)[0];

        return redirect($mediaUrl);
    }

    public function render()
    {
        $this->randomValue = rand($this->minRandomValue, $this->minRandomValue + 100) > $this->randomValue ? rand($this->minRandomValue, $this->minRandomValue + 100) : $this->randomValue;
        $this->memories = Memory::get();

        return view('livewire.dashboard-component')->title('Future Echo - Dashboard');
    }
}
