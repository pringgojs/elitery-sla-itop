<?php

namespace App\Livewire\Pages\Dashboard\Section;

use App\Models\Ticket;
use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\ArrayHelper;
use Livewire\Attributes\Computed;

class Data extends Component
{
    public $barChartTotalTicketPerMonth;
    public $barChartHandlingRequest;
    public $barChartSlaPerAgent;

    public $counter;

    /* jenis tiket kita set default UserRequest */
    public $params = [
        'search' => '',
        'selectedOrg' => [],
        'selectedCaller' => [],
        'selectedAgent' => [],
        'selectedAgentL2' => [],
        'selectedTeam' => [],
        'selectedStatus' => [],
        'selectedType' => ['UserRequest'],
        'dateType' => 'other-month',
        'month' => '11',
        'year' => '2024',
        'dateStart' => '',
        'dateEnd' => '',
    ];


    public function mount()
    {
        $this->counter = $this->counter();
        $this->barChartHandlingRequest = self::barChartHandlingRequestPerDept();
        $this->barChartTotalTicketPerMonth = self::barChartTotalTicketPerMonth();
        $this->barChartSlaPerAgent = self::barChartSlaPerAgent();
    }
    
    #[Computed]
    public function counter()
    {
        $type = $this->params['selectedType'][0] ?? 'UserRequest';
        $statuses = status_by_type($type);

        $data = [];
        foreach ($statuses as $status) {
            $count = Ticket::filter($this->params)->status([$type], [$status['id']])->count();
            array_push($data, [
                'id' => $status['id'],
                'type' => $type,
                'name' => $status['name'],
                'count' => $count,
            ]);
        }

        return $data;
    }

    // #[Computed]
    public function barChartHandlingRequestPerDept()
    {
        $type = $this->params['selectedType'][0] ?? 'UserRequest';

        $data['title'] = 'Total Ticket by Department ('. $type .')';

        $data['legend'] = Contact::classTeam()->select(['id', 'name'])->pluck('name')->toArray();


        $counter = [];
        foreach (Contact::classTeam()->select(['id', 'name'])->get() as $item) {
            $counter[] = Ticket::filter($this->params)->where('team_id', $item->id)->count();
        }

        $data['series'] = [
            [
                'label' => self::getMonth(),
                'data' => $counter,
                'backgroundColor' => ['#10B981'],
                'borderColor' => ['#10B981'],
                'borderWidth' => 1,
            ]
        ];

        return $data;
    }

    public function barChartTotalTicketPerMonth()
    {
        $data['title'] = 'Total Ticket per Month ('. $this->getMonth() .')';

        $data['legend'] = $this->getDateList()['label'];

        $type = $this->params['selectedType'][0] ?? 'UserRequest';

        $counter = [];
        foreach ($this->getDateList()['date'] as $item) {
            $this->params['selectedType'] = [$type];

            $count = Ticket::filter($this->params)->whereDate('start_date', $item)->count();
            
            $counter[] = $count;
        }

        $data['series'] = [
            [
                'label' => self::getMonth(),
                'data' => $counter,
                'backgroundColor' => ['#10B981'],
                'borderColor' => ['#10B981'],
                'borderWidth' => 1,
            ]
        ];

        return $data;
    }

    public function barChartSlaPerAgent()
    {
        $agents = Contact::classPerson()
            ->selectFullName()
            ->where('org_id', 1)
            ->get()
            ->chunk(30);

        $charts = [];
        foreach ($agents as $chunkIndex => $chunk) {
            $data['title'] = 'SLA by Agent (Group ' . ($chunkIndex + 1) . ')';

            $data['legend'] = $chunk->pluck('name')->toArray(); // agent name

            $seriesL1ResponseTime = [];
            $seriesL2ResponseTime = [];
            $seriesL2ResolutionTime = [];
            foreach ($chunk as $agent) {
                $agentL1ResponseTime = Ticket::filter($this->params)->where('agent_l1_id', $agent->id)->sum('agent_l1_response_time');
                $agentL2ResponseTime = Ticket::filter($this->params)->where('agent_l2_id', $agent->id)->sum('agent_l2_response_time');
                $agentL2ResolutionTime = Ticket::filter($this->params)->where('agent_l2_id', $agent->id)->sum('agent_l2_resolution_time');
                
                $seriesL1ResponseTime[] = $agentL1ResponseTime > 0 ? round($agentL1ResponseTime / 60) : 0;
                $seriesL2ResponseTime[] = $agentL2ResponseTime > 0 ? round($agentL2ResponseTime / 60) : 0;
                $seriesL2ResolutionTime[] = $agentL2ResolutionTime > 0 ? round($agentL2ResolutionTime / 60) : 0;
            }


            $data['series'] = [
                [
                    'label' => 'Response Time L1 (in minutes)',
                    'data' => $seriesL1ResponseTime,
                    'backgroundColor' => ['#10B981'],
                    'borderColor' => ['#10B981'],
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Response Time L2 (in minutes)',
                    'data' => $seriesL2ResponseTime,
                    'backgroundColor' => ['#3B82F6'],
                    'borderColor' => ['#3B82F6'],
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Resolution Time L2 (in minutes)',
                    'data' => $seriesL2ResolutionTime,
                    'backgroundColor' => ['#FBBF24'],
                    'borderColor' => ['#FBBF24'],
                    'borderWidth' => 1,
                ]   
            ];

            $charts[] = $data;
        }

        return $charts;
    }

    public function getMonth()
    {
        if ($this->params['dateType'] == 'this-month') {
            return date('F Y');
        }
        if ($this->params['dateType'] == 'this-year') {
            return 'Year:'. date('Y');
        }
        if ($this->params['dateType'] == 'other-month') {
            return date('F Y', mktime(0, 0, 0, $this->params['month'], 1, $this->params['year']));
        }
        if ($this->params['dateType'] == 'other-year') {
            return 'Year:'. $this->params['year'];
        }
    }

    public function getDateList()
    {
        $dates = [];

        if ($this->params['dateType'] == 'this-month') {
            $start = strtotime(date('Y-m-01'));
            $end = strtotime(date('Y-m-t'));
        } elseif ($this->params['dateType'] == 'other-month') {
            $start = strtotime($this->params['year'] . '-' . $this->params['month'] . '-01');
            $end = strtotime(date('Y-m-t', $start));
        } else {
            return $dates; // Return empty array for unsupported dateType
        }

        $label = [];
        $date = [];
        for ($current = $start; $current <= $end; $current = strtotime('+1 day', $current)) {
            $date[] = date('Y-m-d', $current);
            $label[] = date('d M', $current);
        }

        return [
            'date' => $date,
            'label' => $label,
        ];
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

        $chartHandlingRequest = self::barChartHandlingRequestPerDept();
        $chartTicketPerMonth = self::barChartTotalTicketPerMonth();
        $chartSlaPerAgent = self::barChartSlaPerAgent();

        $counter = $this->counter();
        
        $this->dispatch('on-update-counter', $counter);
        $this->dispatch('on-update-handling-request-per-dept', legend: $chartHandlingRequest['legend'], series: $chartHandlingRequest['series']);
        $this->dispatch('on-update-ticket-per-month', legend: $chartTicketPerMonth['legend'], series: $chartTicketPerMonth['series']);

        foreach ($chartSlaPerAgent as $index => $chart) {
            $this->dispatch('on-update-sla-per-agent-'.$index, legend: $chart['legend'], series: $chart['series']);
        }
    }

    public function render()
    {
        return view('livewire.pages.dashboard.section.data');
    }
}
