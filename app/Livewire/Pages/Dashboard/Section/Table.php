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
        $items = Contact::classPerson()
            ->selectFullName()
            ->orderByDefault()
            ->where('org_id', 1)
            ->get();

        $tickets = \App\Models\Ticket::filter($this->params)
            ->select(['agent_l1_id', 'agent_l2_id', 'agent_l1_response_time', 'agent_l2_response_time', 'agent_l2_resolution_time', 'resolution_time_real', 'pending_time'])
            ->get();

        $result = [];
        foreach ($items as $agent) {
            $l1Tickets = $tickets->where('agent_l1_id', $agent->id);
            $l2Tickets = $tickets->where('agent_l2_id', $agent->id);

            $agentL1ResponseTime = $l1Tickets->sum('agent_l1_response_time');
            $agentL2ResponseTime = $l2Tickets->sum('agent_l2_response_time');
            $agentL2ResolutionTime = $l2Tickets->sum('agent_l2_resolution_time');
            $resolutionTimeReal = $l2Tickets->sum('resolution_time_real');
            $pendingTime = $l2Tickets->sum('pending_time');

            $seriesL1ResponseTime = $agentL1ResponseTime > 0 ? round($agentL1ResponseTime / 60) : 0;
            $seriesL2ResponseTime = $agentL2ResponseTime > 0 ? round($agentL2ResponseTime / 60) : 0;
            $seriesL2ResolutionTime = $agentL2ResolutionTime > 0 ? round($agentL2ResolutionTime / 60) : 0;
            $seriesResponseTimeReal = $resolutionTimeReal > 0 ? round($resolutionTimeReal / 60) : 0;
            $seriesPendingTime = $pendingTime > 0 ? round($pendingTime / 60) : 0;

            // Hanya tambahkan jika salah satu dari tiga kolom ada isinya (tidak 0)
            if ($seriesL1ResponseTime || $seriesL2ResponseTime || $seriesL2ResolutionTime) {
                $result[] = [
                    'name' => $agent->name,
                    'response_time_l1' => $seriesL1ResponseTime . ' m',
                    'response_time_l2' => $seriesL2ResponseTime . ' m',
                    'resolution_time' => $seriesL2ResolutionTime . ' m',
                    'resolution_time_real' => $seriesResponseTimeReal . ' m',
                    'pending_time' => $seriesPendingTime . ' m',
                ];
            }
        }

        // Pagination manual
        $page = request()->get('page', 1);
        $perPage = 5;
        $resultCollection = collect($result);
        $paginated = new LengthAwarePaginator(
            $resultCollection->forPage($page, $perPage),
            $resultCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $paginated; 
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
