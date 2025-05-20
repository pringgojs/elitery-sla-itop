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
            ->where('contact.org_id', 1)
            ->groupBy('contact.id', 'contact.name', 'ticket.agent_l1_id', 'ticket.agent_l2_id');

        $result = $query->paginate($perPage);

        // Format hasil agar sesuai tampilan sebelumnya (dalam menit dan ada satuan ' m')
        $result->getCollection()->transform(function ($row) {
            return [
                'name' => $row->name,
                'response_time_l1' => $row->response_time_l1 > 0 ? round($row->response_time_l1 / 60) . ' m' : '0 m',
                'response_time_l2' => $row->response_time_l2 > 0 ? round($row->response_time_l2 / 60) . ' m' : '0 m',
                'resolution_time' => $row->resolution_time > 0 ? round($row->resolution_time / 60) . ' m' : '0 m',
                'resolution_time_real' => $row->resolution_time_real > 0 ? round($row->resolution_time_real / 60) . ' m' : '0 m',
                'pending_time' => $row->pending_time > 0 ? round($row->pending_time / 60) . ' m' : '0 m',
            ];
        });

        // Filter hanya jika salah satu dari tiga kolom ada isinya (tidak 0)
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
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.section.table');
    }
}
