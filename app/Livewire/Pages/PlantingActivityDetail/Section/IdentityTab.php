<?php

namespace App\Livewire\Pages\PlantingActivityDetail\Section;

use Livewire\Component;
use Livewire\Attributes\Computed;

class IdentityTab extends Component
{
    public $form;

    #[Computed]
    public function getFields()
    {
        return [
            'Tanggal Kegiatan' => date_format_human($this->form->created_at),
            'Jenis Kegiatan Tanam' => $this->form->activityType->name ?? '-',
            'Pelaksana Kegiatan (Nama Dinas/Instansi)' => $this->form->activity_organizer,
            'Kabupaten' => $this->form->regency->name ?? '-',
            'Kecamatan' => $this->form->district->name ?? '-',
            'Desa' => $this->form->village->name ?? '-',
            'Blok/dukuh' => $this->form->area_detail,
        ];
    }
    public function render()
    {
        return view('livewire.pages.planting-activity-detail.section.identity-tab');
    }
}
