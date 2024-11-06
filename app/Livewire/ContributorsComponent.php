<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\ContributorPermission;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContributorsComponent extends Component
{
    public $capsule;
    public $email;
    public $permission;

    public function mount(Capsule $capsule)
    {
        $this->permission = 'r';
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'permission' => 'required|string|in:r,w'
        ];
    }

    public function rulesAttribute(): array
    {
        return [
            'email' => 'contributor email address',
            'permission' => 'contributor permission'
        ];
    }

    public function addContributor()
    {
        $this->validate();

        $capsule = $this->capsule;
        $userId = User::where([
            ['email', '=', $this->email],
        ])->first()?->id;

        if ($userId && Contributor::where([
            ['user_id', '=', $userId],
            ['capsule_id', '=', $capsule->id],
        ])->exists()) {
            session()->flash('status', 500);
            session()->flash('message', __('Contributor is already exists on your capsule!'));
            $this->render();
            return;
        }

        if ($capsule->user_id != $userId && User::where('email', $this->email)->exists()) {

            DB::beginTransaction();
            try {
                $contributor = Contributor::create([
                    'user_id' => $userId,
                    'capsule_id' => $capsule->id,
                ]);

                $contributorPermission = ContributorPermission::create([
                    'permission' => $this->permission,
                    'contributor_id' => $userId,
                    'capsule_id' => $capsule->id,
                ]);

                DB::commit();

                session()->flash('status', $contributorPermission && $contributor ? 200 : 500);
                session()->flash('message', $contributorPermission && $contributor ? __('Contributor added successfully') : __('Failed to add contributor, please try again later! '));

                $this->reset(['email']);
                $this->render();
            } catch (Exception $e) {
                info($e);
                DB::rollBack();
            }
        } else {
            session()->flash('status', 500);
            session()->flash('message', __('Something went wrong, you cannot perform this action right now!'));
        }
    }

    public function cancel()
    {
        return $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.contributors-component')->title('Future Echo - Contributors');
    }
}
