<?php

namespace App\Livewire\Pages\Dashboard\Section;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Pagination\LengthAwarePaginator;
class Table extends Component
{
    use WithPagination;

    public $params = [];

    #[Computed]
    public function items()
    {
        $perPage = 5;
        $query = \App\Models\Ticket::filter($this->params)
            ->selectRaw('
                CONCAT(person.first_name, " ", contact.name) as fullname,
                contact.name as name,
                ticket.agent_l1_id,
                ticket.agent_l2_id,
                SUM(ticket.agent_l1_response_time) as response_time_l1,
                SUM(ticket.agent_l2_response_time) as response_time_l2,
                SUM(ticket.agent_l2_resolution_time) as resolution_time,
                SUM(ticket.resolution_time_real) as resolution_time_real,
                SUM(ticket.pending_time) as pending_time
            ')
            ->join('contact', function($join) {
                $join->on('contact.id', '=', 'ticket.agent_l1_id')
                     ->orOn('contact.id', '=', 'ticket.agent_l2_id');
            })
            ->leftJoin('person', 'person.id', '=', 'contact.id')
            ->where('contact.org_id', 1)
            ->groupBy('contact.id', 'person.first_name', 'contact.name', 'ticket.agent_l1_id', 'ticket.agent_l2_id');

        $result = $query->paginate($perPage);

        $result->getCollection()->transform(function ($row) {
            return [
                'fullname' => $row->fullname,
                'name' => $row->name,
                'response_time_l1' => $row->response_time_l1 > 0 ? convert_seconds($row->response_time_l1) : 0,
                'response_time_l2' => $row->response_time_l2 > 0 ? convert_seconds($row->response_time_l2) : 0,
                'resolution_time' => $row->resolution_time > 0 ? convert_seconds($row->resolution_time) : 0,
                'resolution_time_real' => $row->resolution_time_real > 0 ? convert_seconds($row->resolution_time_real) : 0,
                'pending_time' => $row->pending_time > 0 ? convert_seconds($row->pending_time) : 0,
            ];
        });

        $result->setCollection(
            $result->getCollection()->filter(function ($row) {
                return $row['response_time_l1'] !== '0 m' || $row['response_time_l2'] !== '0 m' || $row['resolution_time'] !== '0 m';
            })->values()
        );

        return $result;
    }

    #[On('filter')]
    public function filter($params)
    {
        $this->params = $params;
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.section.table');
    }
}
