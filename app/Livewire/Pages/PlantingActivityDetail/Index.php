<?php

namespace App\Livewire\Pages\PlantingActivityDetail;

use Livewire\Component;
use App\Models\PlantingActivity;

class Index extends Component
{
    public $id;

    public $plantingActivity;
    public function mount()
    {
        $this->plantingActivity = PlantingActivity::findOrFail($this->id);
    }
    public function render()
    {
        return view('livewire.pages.planting-activity-detail.index');
    }
}
