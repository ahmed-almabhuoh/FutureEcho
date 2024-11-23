<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\ContributorPermission;
use App\Models\Legacy;
use App\Models\Memory;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RecoverLegacyComponent extends Component
{
    public $pass_key;

    public function mount() {}

    public function rules(): array
    {
        return [
            'pass_key' => 'required|string|min:2|max:50',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'pass_key' => 'PASS-KEY',
        ];
    }

    public function recoverLegacy()
    {
        $this->validate();
        $legacyObject = Legacy::withoutGlobalScopes()->where([
            ['status', '=', 'accepted'],
            ['email', '=', auth()->user()->email],
        ])->first();
        $user = User::where('id', $legacyObject->user_id)->first();
        $legacy = auth()->user();

        if (!is_null($legacy)) {
            if (Hash::check($this->pass_key, $legacyObject->pass_key)) {

                DB::beginTransaction();

                try {
                    // Capsules
                    Capsule::where('user_id', $user->id)->update([
                        'user_id' => $legacy->id,
                    ]);

                    // Contributors & Permission
                    Contributor::where('user_id', $user->id)->update([
                        'user_id' => $legacy->id,
                    ]);
                    ContributorPermission::where('contributor_id', $user->id)->update([
                        'contributor_id' => $legacy->id,
                    ]);

                    // Memories
                    Memory::where('user_id', $user->id)->update([
                        'user_id' => $legacy->id,
                    ]);

                    DB::commit();

                    $legacyObject->pass_key = null;
                    $legacyObject->save();

                    session()->flash('message', 'Recover completed successfully!');
                    session()->flash('status', 200);

                    return redirect(route('memories'));
                } catch (Exception $e) {
                    info($e);
                    DB::rollBack();

                    session()->flash('message', 'Failed to complete process, please try again later!');
                    session()->flash('status', 500);

                    $this->render();
                }
            } else {
                session()->flash('message', 'Invalid credentials, please try again later!');
                session()->flash('status', 500);

                $this->render();
            }
        } else {
            session()->flash('message', 'Failed to complete recovery process, try again later!');
            session()->flash('status', 500);

            $this->render();
            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.recover-legacy-component')->title('Recover Legacy');
    }
}
