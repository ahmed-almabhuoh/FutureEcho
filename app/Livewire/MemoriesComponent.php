<?php

namespace App\Livewire;

use App\Models\Memory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
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
        Memory::where('id', $this->toBeDeletedId)->delete();
        // $this->reset('toBeDeletedId');
        session()->flash('message', 'Memory deleted successfully!');
        session()->flash('status', 200);
        return $this->redirect(route('memories'));
    }

    public function render()
    {
        $memories = Memory::withoutGlobalScopes()
            ->where('deleted_at', '=', null)
            ->with(['capsule', 'user'])
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereHas('capsule', function ($subQuery) {
                        $subQuery->where('user_id', auth()->id());
                    })
                    ->orWhereHas('capsule.contributors', function ($subQuery) {
                        $subQuery->where('user_id', auth()->id());
                    });
            })
            ->paginate(10);

        return view('livewire.memories-component', [
            'memories' => $memories,
        ])->title('Future Echo - Memories');
    }
}
