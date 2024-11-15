<?php

namespace App\Livewire;

use App\Models\Memory;
use App\Models\TimeLine;
use Carbon\Carbon;
use Livewire\Component;

class TimelineComponent extends Component
{
    public $memory;
    public $from;
    public $to;
    public $memory_timeline;

    public function mount()
    {
        $this->memory = Memory::where('user_id', auth()->id())->select(['id'])->first()->id;
    }

    public function updatedMemory()
    {
        $this->memory_timeline = TimeLine::where('memory_id', $this->memory)->first();

        if (! is_null($this->memory_timeline)) {
            // dd(Carbon::parse($this->memory_timeline->from)->format('m/d/yy'));
            $this->from = Carbon::parse($this->memory_timeline->from)->format('m/d/yy');
            $this->to = Carbon::parse($this->memory_timeline->to)->format('m/d/yy');
        }
    }

    public function newTimeline()
    {
        $this->validate();

        if (is_null($this->memory_timeline)) {
            TimeLine::create([
                'from' => $this->from,
                'to' => $this->to,
                'memory_id' => $this->memory,
                'capsule_id' => Memory::where('id', $this->memory)->first()->capsule,
            ]);

            session()->flash('message', 'Timeline added successfully');
            session()->flash('status', 200);

            return redirect()->route('memories');
        } else {
            TimeLine::where('id', $this->memory)->update([
                'from' => $this->from,
                'to' => $this->to,
                'memory_id' => $this->memory,
                'capsule_id' => Memory::where('id', $this->memory)->first()->capsule,
            ]);

            session()->flash('message', 'Timeline updated successfully');
            session()->flash('status', 200);

            return redirect()->route('memories');
        }
    }

    public function rules(): array
    {
        return [
            'from' => 'required|date',
            'to' => 'nullable|date',
        ];
    }

    public function ruleAttributes(): array
    {
        return [
            'from' => 'from date',
            'to' => 'to date',
        ];
    }

    public function render()
    {
        return view('livewire.timeline-component', [
            'memories' => Memory::where('user_id', auth()->id())->select(['id', 'message'])->get()->pluck('message', 'id')->toArray(),
        ])->title('Future Echo - Memory Timeline');
    }
}
