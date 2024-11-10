<?php

namespace App\Livewire;

use App\Models\Capsule;
use Livewire\Component;

class CreateCapsuleComponent extends Component
{
    public $title;

    public function mount() {}

    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:capsules,title,NULL,id,user_id,' . auth()->id(),
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'title' => 'capsule title',
        ];
    }

    public function cancel()
    {
        return redirect(route('capsules.index'));
    }

    public function  newCapsule()
    {
        $this->validate();

        $capsule = Capsule::create([
            'title' => $this->title,
        ]);

        session()->flash('message', $capsule ?  'New capsule added' : 'Failed to add new capsule, please try again later!');
        session()->flash('status', $capsule ? 200 : 500);

        return redirect()->route('capsules.index');
    }

    public function render()
    {
        return view('livewire.create-capsule-component')->title('Future Echo - Create Capsule');
    }
}
