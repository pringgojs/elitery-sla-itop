<?php

namespace App\Livewire\Pages\Dashboard\Section;

use App\Models\Ticket;
use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\ArrayHelper;
use App\Exports\TicketExport;
use Livewire\Attributes\Computed;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Pages\Dashboard\Section\Table;

class Data extends Component
{
    public $barChartTotalTicketPerMonth;
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
        'dateType' => 'this-month',
        'month' => '',
        'year' => '',
        'dateStart' => '',
        'dateEnd' => '',
    ];


    public function mount()
    {
        $this->counter = $this->counter();
        $this->barChartTotalTicketPerMonth = self::barChartTotalTicketPerMonth();
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

    public function handlingRequestTitle()
    {
        $type = $this->params['selectedType'][0] ?? 'UserRequest';

        return 'Total Ticket by Department ('. $type .')';
    }

    public function ticketPerMonthTitle()
    {
        return 'Total Ticket per Month ('. $this->getMonth() .')';
    }

    public function barChartTotalTicketPerMonth()
    {
        $data['title'] = self::ticketPerMonthTitle();

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

    #[Computed]
    public function treemapChartTicketPerDept()
    {
        $data['title'] = self::handlingRequestTitle();

        $data['legend'] = Contact::classTeam()->select(['id', 'name'])->pluck('name')->toArray();

        $colors = $this->generateRandomColors(count($data['legend']));

        $counter = [];
        foreach (Contact::classTeam()->select(['id', 'name'])->get() as $i => $item) {
            $count = Ticket::filter($this->params)->where('team_id', $item->id)->count();
            $series = [
                'what' => $item->name,
                'value' => $count,
                'color' => $colors[$i],
            ];

            array_push($counter, $series);
        }

        $data['series'] = $counter;
        $data['label'] = 'Department';

        return $data;
    }

    public function generateRandomColors($count = 5)
    {
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
        }

        return $colors;
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

        return date('F Y');
    }

    public function getDateList()
    {
        $dates = [];

        if (!$this->params['dateType']) {
            $this->params['dateType'] = 'this-month';
        }

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

        $chartHandlingRequest = self::treemapChartTicketPerDept();
        $chartTicketPerMonth = self::barChartTotalTicketPerMonth();
        $counter = $this->counter();

        
        $this->dispatch('filter', params: $params)->to(Table::class);
        $this->dispatch('on-update-counter', $counter);
        $this->dispatch('on-update-ticket-per-month', legend: $chartTicketPerMonth['legend'], series: $chartTicketPerMonth['series']);
        
        $key = 'bar-chart-ticket-per-month';
        $this->dispatch('bar-chart-update-title-'.$key, self::ticketPerMonthTitle());
    }

    #[On('export')]
    public function export()
    {
        $this->authorize('ticket.export');

        return Excel::download(new TicketExport($this->params), 'ticket-'.date('Ymd').'.xlsx');
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.section.data');
    }
}
