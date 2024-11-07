<?php

namespace App\Livewire\V1;

use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.v1.dashboard-component')->title('Future Echo - Dashboard');
    }
}
