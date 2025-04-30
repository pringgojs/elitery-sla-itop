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
        'month' => '2',
        'year' => '2025',
        'dateStart' => '',
        'dateEnd' => '',
    ];


    public function mount()
    {
        $this->counter = $this->counter();
        $this->barChartHandlingRequest = self::barChartHandlingRequestPerDept();
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

        $counter = $this->counter();

        $this->dispatch('on-update-handling-request-per-dept', legend: $chartHandlingRequest['legend'], series: $chartHandlingRequest['series']);
        $this->dispatch('on-update-ticket-per-month', legend: $chartTicketPerMonth['legend'], series: $chartTicketPerMonth['series']);

        $this->dispatch('on-update-counter', $counter);
        // $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.dashboard.section.data');
    }
}
