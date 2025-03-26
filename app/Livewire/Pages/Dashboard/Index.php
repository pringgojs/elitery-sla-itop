<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Utils\Maps;
use App\Models\PlantingActivity;
use Livewire\Attributes\Computed;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard.index');
    }
}
