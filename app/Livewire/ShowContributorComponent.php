<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContributorComponent extends Component
{
    use WithPagination;

    protected $users;

    public function mount()
    {
        $capsules = Capsule::where('user_id', auth()->id())->select(['id'])->get()->toArray();
        $contributors = Contributor::whereIn('capsule_id', $capsules)->select(['user_id'])->get()->toArray();
        $this->users = User::whereIn('id', $contributors)->select(['id', 'name', 'email', 'image'])->paginate(5);
    }

    public function render()
    {
        return view('livewire.show-contributor-component', [
            'contributors' => $this->users,
        ])->title('Future Echo - Contributors');
    }
}
