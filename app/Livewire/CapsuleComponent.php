<?php

namespace App\Livewire;

use App\Models\Capsule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CapsuleComponent extends Component
{
    #[Layout('layouts.dashboard')]

    public $title;

    public function mount() {}

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:45',
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
        return $this->redirect(route('dashboard'));
    }

    public function addCapsule()
    {
        $this->validateOnly('title');

        $capsule = Capsule::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
        ]);

        if (! is_null($capsule)) {
            session()->flash('status', 200);
            session()->flash('message', __('Capsule') . $this->title . ' ' . __('created successfully, start adding you contributors'));
            $this->reset(['title']);

            // Here should redirected to add contributors for created capsules
            return $this->redirect(route('capsules.contributors', $capsule->id));
        } else {
            session()->flash('status', 500);
            session()->flash('message', __('Failed to create new capsule, please try again later!'));
        }
    }

    public function render()
    {
        return view('livewire.capsule-component')->title('Future Echo - Capsule');
    }
}
