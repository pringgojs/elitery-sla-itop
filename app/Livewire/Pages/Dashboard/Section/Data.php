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
    /* jenis tiket kita set default UserRequest */
    public $params = [
        'search' => '',
        'selectedOrg' => [],
        'selectedCaller' => [],
        'selectedAgent' => [],
        'selectedAgentL2' => [],
        'selectedTeam' => [],
        'selectedStatus' => [],
        'selectedType' => [],
        'dateType' => 'this-month',
        'month' => '',
        'year' => '',
        'dateStart' => '',
        'dateEnd' => '',
    ];

    #[Computed]
    public function counter()
    {
        $type = $this->params['selectedType'][0] ?? 'UserRequest';
        $statuses = status_by_type($type);

        $data = [];
        foreach ($statuses as $status) {
            $this->params['selectedStatus'] = [$status['id']];
            $this->params['selectedType'] = [$type];

            $count = Ticket::filter($this->params)->count();
            array_push($data, [
                'id' => $status['id'],
                'type' => $type,
                'name' => $status['name'],
                'count' => $count,
            ]);
        }

        return $data;
    }

    #[Computed]
    public function barChartHandlingRequestPerDept()
    {
        $data['title'] = 'Handling Request Per Department';

        $data['legend'] = Contact::classTeam()->select(['id', 'name'])->pluck('name')->toArray();

        $type = $this->params['selectedType'][0] ?? 'UserRequest';

        $counter = [];
        foreach (Contact::classTeam()->select(['id', 'name'])->get() as $item) {
            $this->params['selectedType'] = [$type];
            $this->params['selectedTeam'] = [$item->id];

            $count = Ticket::filter($this->params)->count();
            
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
            return date('F Y', strtotime($this->params['month'] . ' ' . $this->params['year']));
        }
        if ($this->params['dateType'] == 'other-year') {
            return 'Year:'. date('Y', strtotime($this->params['year']));
        }
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

        $barChartHandlingRequestPerDept = $this->barChartHandlingRequestPerDept;

        $this->dispatch('on-update-handling-request-per-dept', legend: $barChartHandlingRequestPerDept['legend'], series: $barChartHandlingRequestPerDept['series']);

        // $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.dashboard.section.data');
    }
}
