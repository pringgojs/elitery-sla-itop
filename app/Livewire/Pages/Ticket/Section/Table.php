<?php

namespace App\Livewire\Pages\Ticket\Section;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\ArrayHelper;
use Livewire\WithPagination;
// use Maatwebsite\Excel\Excel;
use App\Exports\TicketExport;
use Livewire\Attributes\Computed;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;
    
    protected $listeners = ['refreshComponent' => '$refresh'];

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
        $this->authorize('ticket.export');

        return Excel::download(new TicketExport($this->params), 'ticket-'.date('Ymd').'.xlsx');
    }

    public function recalculate($id)
    {
        $this->authorize('ticket.recalculate');
        
        $ticket = Ticket::findOrFail($id);
        $ticket->recalculate();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
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
            'selectedCaller' => $filteredItem['caller'] ?? [],
            'selectedAgent' => $filteredItem['agent'] ?? [],
            'selectedAgentL2' => $filteredItem['agent_l2'] ?? [],
            'selectedTeam' => $filteredItem['team'] ?? [],
            'selectedStatus' => $filteredItem['status'] ?? [],
            'selectedType' => $filteredItem['type'] ?? [],
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
