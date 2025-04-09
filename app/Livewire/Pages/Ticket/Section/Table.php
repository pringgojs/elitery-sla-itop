<?php

namespace App\Livewire\Pages\Ticket\Section;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;
use Livewire\Attributes\Computed;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Helpers\ArrayHelper;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $modalConfirmDelete = false;
    public $params = [];

    #[Computed]
    public function items()
    {
        return Ticket::filter($this->params)->with(['organization', 'agent', 'team', 'caller'])->orderByDefault()->paginate();
    }

    #[On('export')]
    public function export()
    {
        return Excel::download(new PlantingActivityExport($this->params), 'data-kegiatan-tanam-pohon-'.date('Ymd').'.xlsx');
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    #[On('filter')]
    public function filter(
        $search = null,
        $selected = null,
        $dateType = null,
        $month = null,
        $year = null,
        $dateStart = null,
        $dateEnd = null
    ) {

        $filteredItem = ArrayHelper::extractIds($selected);

        $params = [
            'search' => $search,
            'selectedOrg' => $filteredItem['organization'] ?? [],
            'selectedCaller' => $organization = $filteredItem['caller'] ?? [],
            'selectedAgent' => $filteredItem['agent'] ?? [],
            'selectedTeam' => $filteredItem['team'] ?? [],
            'dateType' => $dateType,
            'month' => $month,
            'year' => $year,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ];

        $this->params = $params;

        $this->resetPage();

    }

    public function render()
    {
        return view('livewire.pages.ticket.section.table');
    }
}
