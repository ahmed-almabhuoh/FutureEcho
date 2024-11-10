<?php

namespace App\Livewire;

use App\Models\Capsule;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class CapsulesComponent extends Component
{
    protected $capsules;
    public $toDeleted;

    public function mount() {}

    public function setToBeDeleted($id)
    {
        $this->toDeleted = Crypt::decrypt($id);
    }

    public function delete()
    {
        $isDeleted = Capsule::where([
            ['user_id', '=', auth()->id()],
            ['id', '=', $this->toDeleted],
        ])->delete();

        session()->flash('message', $isDeleted ? 'Capsule deleted' : 'Failed to delete capsule, please try again later!');
        session()->flash('status', $isDeleted ? 200 : 500);

        return redirect(route('capsules.index'));
    }

    public function close() {}

    public function render()
    {
        $this->capsules = Capsule::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate();

        return view('livewire.capsules-component', [
            'capsules' => $this->capsules,
        ])->title('Future Echo - Capsules');
    }
}
