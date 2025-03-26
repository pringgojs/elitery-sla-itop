<?php

namespace App\Livewire\Pages\PlantingActivity\Section;

use App\Models\Seed;
use Livewire\Component;
use Livewire\Attributes\Computed;

class FormStep2 extends Component
{
    #[Computed]
    public function getSeeds()
    {
        return Seed::orderByDefault()->get();
    }
    
    public function render()
    {
        return view('livewire.pages.planting-activity.section.form-step2');
    }
}
