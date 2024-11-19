<?php

namespace App\Livewire\V1;

use App\Models\Memory;
use Livewire\Component;

class DashboardComponent extends Component
{
    protected $memories;

    public function mount()
    {
        return redirect()->route('memories');
    }

    public function render()
    {
        $user = auth()->user();

        $this->memories = Memory::withoutGlobalScopes()
            ->with(['capsule', 'user'])
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereHas('capsule', function ($subQuery) use ($user) {
                        $subQuery->where('user_id', $user->id);
                    })
                    ->orWhereHas('capsule.contributors', function ($subQuery) use ($user) {
                        $subQuery->where('user_id', $user->id);
                    });
            })
            ->paginate(10);

        return view('livewire.v1.dashboard-component', [
            'memories' => $this->memories
        ])->title('Future Echo - Dashboard');
    }
}
