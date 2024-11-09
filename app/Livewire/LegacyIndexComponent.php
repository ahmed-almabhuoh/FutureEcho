<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LegacyIndexComponent extends Component
{
    public $legacy;

    public function delete()
    {
        $userLegacy = auth()->user()->legacy()->first();

        if ($userLegacy->status != 'accepted') {

            $isDeleted = $userLegacy->delete();

            session()->flash('message', $isDeleted ?  __('Legacy deleted') : __('Failed to delete legacy, please try again later!'));
            session()->flash('status', $isDeleted ? 200 : 500);

            return redirect(route('legacy'));
        } else {
            session()->flash('message', __('You cannot delete accepted legacy!'));
            session()->flash('status', 500);

            return redirect(route('legacy'));
        }
    }

    public function render()
    {
        return view('livewire.legacy-index-component')->title('Future Echo - Legacy');
    }
}
