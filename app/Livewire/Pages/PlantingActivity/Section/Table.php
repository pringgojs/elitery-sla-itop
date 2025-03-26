<?php

namespace App\Livewire\Pages\PlantingActivity\Section;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\PlantingActivity;
use Livewire\Attributes\Computed;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlantingActivityExport;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $modalConfirmDelete = false;
    public $params = [];

    #[Computed]
    public function items()
    {
        return PlantingActivity::filter($this->params)->with(['regency', 'district', 'village', 'activityType'])->paginate();

    }

    public function render()
    {
        return view('livewire.pages.planting-activity.section.table');
    }

    #[On('export')]
    public function export()
    {
        return Excel::download(new PlantingActivityExport($this->params), 'data-kegiatan-tanam-pohon-'.date('Ymd').'.xlsx');
    }

    public function delete($id)
    {
        $this->authorize('kegiatan.penanaman.pohon.delete');
        $model = PlantingActivity::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->redirectRoute('planting-activity.index', navigate: true);
    }

    public function updatingfilter()
    {
        $this->resetPage();
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

        info($params);

    }
}
