<?php

namespace App\Livewire;

use App\Models\Memory;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class MemoriesComponent extends Component
{
    public $toBeDeletedId;

    public function setToBeDeleted($encryptedId)
    {
        $this->toBeDeletedId = Crypt::decrypt($encryptedId);
    }

    public function delete()
    {
        Memory::findOrFail($this->toBeDeletedId)->delete();
        $this->reset('toBeDeletedId');
        session()->flash('message', 'Memory deleted successfully!');
    }

    public function render()
    {
        return view('livewire.memories-component', [
            'memories' => Memory::with('capsule', 'user')
                ->where('user_id', auth()->id())
                ->paginate(10),
        ])->title('Future Echo - Memories');
    }
}
