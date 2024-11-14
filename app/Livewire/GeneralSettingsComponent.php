<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralSettingsComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $image;
    public $currentImage;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->currentImage = $user->image;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:45',
            'phone' => 'nullable|string|min:7|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function getImagePreviewProperty()
    {
        return $this->image ? $this->image->temporaryUrl() : ($this->currentImage ? asset('storage/' . $this->currentImage) : 'version-1/assets/media/users/100_3.jpg');
    }

    public function updateSettings()
    {
        $this->validate();

        $user = Auth::user();

        $user->name = $this->name;
        $user->phone = $this->phone;

        if ($this->image) {
            $path = $this->image->store('profile_images', 'public');
            $user->image = $path;
            $this->currentImage = $path; // Update current image path
        }

        $user->save();

        session()->flash('message', 'Settings updated successfully.');
        session()->flash('status', 200);
    }

    public function removeImage()
    {
        $user = Auth::user();

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->image = null;
        $user->save();

        $this->currentImage = null;
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.general-settings-component')->title('Future Echo - General Settings');
    }
}
