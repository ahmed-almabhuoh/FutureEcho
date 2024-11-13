<?php

namespace App\Livewire;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ContributorComponent extends Component
{
    protected $contributors;
    protected $capsules;
    public $email;
    public $capsule_ids;
    public $shouldDeletedUserId;
    public $shouldDeletedCapsuleId;

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'capsule_ids.*' => [
                'required',
                'integer',
                Rule::exists('capsules', 'id')->where('user_id', auth()->id()),
                function ($attribute, $value, $fail) {
                    $contributorId = User::where('email', $this->email)->value('id');

                    if (Contributor::where('user_id', $contributorId)
                        ->where('capsule_id', $value)
                        ->exists()
                    ) {
                        $fail("The contributor already exists in selected capsule.");
                    }
                },
            ],
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'email' => 'contributor email address',
        ];
    }

    public function newContributor()
    {
        $this->validate();

        $selectedContributor = User::where('email', $this->email)->first()->id;

        if (is_array($this->capsule_ids))
            foreach ($this->capsule_ids as $capsuleId) {
                Contributor::create([
                    'user_id' => $selectedContributor,
                    'capsule_id' => $capsuleId,
                ]);
            }
        else {
            session()->flash('message', 'You have to select at least on capsule!');
            session()->flash('status', 500);

            $this->render();
            return;
        }

        session()->flash('message', 'Capsules added successfully');
        session()->flash('status', 200);

        $this->render();
        $this->reset();
    }

    public function delete()
    {
        Contributor::where([
            ['user_id', '=', $this->shouldDeletedUserId],
            ['capsule_id', '=', $this->shouldDeletedCapsuleId],
        ])->delete();

        session()->flash('message', 'Contributor deleted successfully');
        session()->flash('status', 200);

        return redirect()->route('contributors');
    }

    public function setToBeDeleted($user_id, $capsule_id)
    {
        $this->shouldDeletedUserId = Crypt::decrypt($user_id);
        $this->shouldDeletedCapsuleId = Crypt::decrypt($capsule_id);
    }

    public function render()
    {
        $this->contributors = Contributor::whereHas('capsule', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with(['user:id,image,name,email', 'capsule:id,title'])
            ->orderBy('added_at', 'desc')
            ->paginate();
        $this->capsules = Capsule::where('user_id', auth()->id())->pluck('title', 'id')->toArray();

        return view('livewire.contributor-component', [
            'capsules' => $this->capsules,
            'contributors' => $this->contributors,
        ])->title('Future Echo - Contributor');
    }
}
