<?php

namespace App\Livewire;

use App\Models\Capsule;
use Livewire\Component;

class CreateCapsuleComponent extends Component
{
    public $title;
    public $position;
    public $capsule;
    public $capsule_id;

    // public function mount($position = 'create', $capsule_id = null)
    // {
    //     if ($position == 'edit') {
    //         if (is_null($capsule_id))
    //             abort(403);

    //         $this->capsule = Capsule::where([
    //             ['user_id', '=', auth()->id()],
    //             ['id', '=', $capsule_id],
    //         ])->first();
    //         $this->title = $this->capsule->title;

    //         if (is_null($this->capsule)) {
    //             abort(403); // Capsule not found
    //         }
    //     }
    // }

    public function mount($position = 'create', $capsule_id = null)
    {
        if ($position === 'edit') {
            if (is_null($capsule_id)) {
                abort(403);
            }

            // $this->capsule = Capsule::where('id', $capsule_id)
            //     ->where(function ($query) {
            //         $query->where('user_id', auth()->id()) // Check if user is the owner
            //             ->orWhereHas('contributors', function ($contributorQuery) {
            //                 $contributorQuery->where('user_id', auth()->id())
            //                     ->whereHas('permissions', function ($permissionQuery) {
            //                         $permissionQuery->where('permission', 'w'); // Check for 'write' permission
            //                     });
            //             });
            //     })
            //     ->with(['contributors.permissions'])
            //     ->first();

            $this->capsule = Capsule::where([
                ['user_id', '=', auth()->id()],
                ['id', '=', $capsule_id],
            ])
                ->orWhereHas('contributors', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->with(['contributors.user'])
                ->with('contributorPermission', function ($query) {
                    $query->where('permission', 'w');
                })
                ->orderBy('created_at', 'desc')
                ->first();

            if (is_null($this->capsule)) {
                abort(403);
            }

            $this->title = $this->capsule->title;
        }
    }

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

        if ($this->position != 'edit') {
            $capsule = Capsule::create([
                'title' => $this->title,
            ]);
        } else {
            if ($this->capsule->user_id == auth()->id()) {
                Capsule::where([
                    ['id', '=', $this->capsule_id],
                    ['user_id', '=', auth()->id()],
                ])->update(['title' => $this->title]);
            } else {
                Capsule::where([
                    ['id', '=', $this->capsule_id],
                    ['user_id', '=', $this->capsule->user_id],
                ])->update(['title' => $this->title]);
            }

            session()->flash('message', 'Capsule updated');
            session()->flash('status', 200);

            return redirect()->route('capsules.index');
        }


        session()->flash('message', $capsule ?  'New capsule added' : 'Failed to add new capsule, please try again later!');
        session()->flash('status', $capsule ? 200 : 500);

        return redirect()->route('capsules.index');
    }

    public function render()
    {
        return view('livewire.create-capsule-component')->title('Future Echo - Create Capsule');
    }
}
