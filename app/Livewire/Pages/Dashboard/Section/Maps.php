<?php

namespace App\Livewire\Pages\Dashboard\Section;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PlantingActivity;
use Livewire\Attributes\Computed;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlantingActivityExport;

class Maps extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $params;

    #[Computed]
    public function markers()
    {
        $markers = [];
        $items = PlantingActivity::filter($this->params)->select(['id', 'latitude', 'longitude'])->get();
        foreach ($items as $item) {
            $markers[] = [
                'id' => $item->id,
                'lat' => $item->latitude,
                'lng' => $item->longitude,
            ];
        }

        return $markers;
    }

    #[On('filter')]
    public function filter($area = null, $search = null, $selectedDistrict = null, $selectedVillage = null, $selectedRegency = null, $selectedActivityType = null, $selectedSeedType = null, $selectedBudgetSource = null, $selectedSeedSource = null, $dateType = null, $month = null, $year = null, $dateStart = null, $dateEnd = null)
    {
        $params = [
            'area' => $area,
            'search' => $search,
            'selectedRegency' => $selectedRegency,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
            'selectedActivityType' => $selectedActivityType,
            'selectedSeedType' => $selectedSeedType,
            'selectedBudgetSource' => $selectedBudgetSource,
            'selectedSeedSource' => $selectedSeedSource,
            'dateType' => $dateType,
            'month' => $month,
            'year' => $year,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ];

        $this->params = $params;

        $this->dispatch('on-update-marker', $this->markers);
    }

    #[On('export')]
    public function export()
    {
        return Excel::download(new PlantingActivityExport($this->params), 'data-kegiatan-tanam-pohon-'.date('Ymd').'.xlsx');
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.section.maps');
    }
}
