<?php

namespace App\Livewire\Pages\PlantingActivity;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $this->authorize('kegiatan.penanaman.pohon.view');
        
        return view('livewire.pages.planting-activity.index');
    }
}
