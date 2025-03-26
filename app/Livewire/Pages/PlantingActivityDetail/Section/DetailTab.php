<?php

namespace App\Livewire\Pages\PlantingActivityDetail\Section;

use Livewire\Component;
use Livewire\Attributes\Computed;

class DetailTab extends Component
{
    public $form;

    #[Computed]
    public function getFields()
    {
        return [
            'Sumber Bibit' => $this->form->seedSource->name ?? '-',
            'Sumber Dana' => $this->form->budgetSource->name ?? '-',
            'Luas Lahan (Ha)' => $this->form->land_area,
            'Penanggung Jawab' => $this->form->pic_name,
            'Keterangan Kegiatan' => $this->form->activity_note,
            'Latitude' => $this->form->latitude,
            'Longitude' => $this->form->longitude,
        ];
    }

    public function render()
    {
        return view('livewire.pages.planting-activity-detail.section.detail-tab');
    }
}
