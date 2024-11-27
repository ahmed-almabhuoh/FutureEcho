<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Memory;
use App\Models\Receiver;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MemoryReceiverComponent extends Component
{
    public $memory;
    public $receivers = [];
    public $emails = [];
    public $users = [];

    protected $listeners = ['select2Updated'];

    public function select2Updated($receivers = [])
    {
        $this->receivers = $receivers;
        $this->skipRender();
    }

    public function mount($memory)
    {
        $this->memory = Memory::withoutGlobalScopes()->where('id', $memory)->first();
        $this->users = User::all();
        $this->emails = User::whereIn('id', Receiver::where('memory_id', $this->memory->id)->select(['user_id'])->get()->pluck(['user_id'])->toArray())->select(['email'])->get()->pluck('email')->toArray();
    }

    public function rules () : array {
        return [];
    }

    public function addReceivers()
    {
        DB::beginTransaction();
        try {
            Receiver::where('memory_id', $this->memory->id)->delete();

            foreach ($this->receivers as $key => $receiver) {
                $user = User::where('email', $receiver['id'])->first();
                if (! Receiver::where([
                    ['memory_id', '=', $this->memory->id],
                    ['user_id', '=', $user->id],
                ])->exists())
                    Receiver::create([
                        'memory_id' => $this->memory->id,
                        'user_id' => $user->id,
                        'capsule_id' => $this->memory->capsule()->first()?->id,
                    ]);
            }

            DB::commit();

            session()->flash('message', 'Receivers added successfully!');
            session()->flash('status', 200);
        } catch (Exception $e) {
            info($e);
            DB::rollBack();

            session()->flash('message', 'Failed to add receivers, please try again later');
            session()->flash('status', 500);
            // return redirect(route('memories.receivers', $this->memory->id));
        }
    }

    public function render()
    {
        return view('livewire.memory-receiver-component')->title('Future Echo - Receivers');
    }
}
