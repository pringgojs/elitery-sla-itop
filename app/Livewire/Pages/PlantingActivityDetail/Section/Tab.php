<?php

namespace App\Livewire\Pages\PlantingActivityDetail\Section;

use Livewire\Component;
use App\Models\PlantingActivity;
use Livewire\Attributes\Computed;

class Tab extends Component
{
    public $tabActive;

    public $form;

    public function mount()
    {
        $this->tabActive = request()->input('tab') ?: 'tab-identity';
    }

    public function setActive($v)
    {
        $this->tabActive = $v;
    }

    public function render()
    {
        return view('livewire.pages.planting-activity-detail.section.tab');
    }
}
