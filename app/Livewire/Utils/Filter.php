<?php

namespace App\Livewire\Utils;

use App\Models\Seed;
use App\Models\Option;
use App\Models\Contact;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use App\Constants\Constants;
use App\Models\Organization;

class Filter extends Component
{
    public $statusTicketRequest = [];

    public $statusTicketIncident = [];
    
    public $statusTicketProblem = [];
    
    public $statusTicketChange = [];

    public $organizations;

    public $callers;

    public $teams;

    public $agents;

    public $statuses;
    
    public $types;

    public $dateType;

    public $table;

    public $params;

    /* jenis tiket */
    public $type;

    /* use utilitas filter */
    public $useArea = false;

    public $useOrganization = false;

    public $useCaller = false;

    public $useTeam = false;

    public $useAgent = false;

    public $useDate = false;

    public $useDateToday = false;
    
    public $useDateThisMonth = false;
    
    public $useDateOtherMonth = false;

    public $useDateOtherYear = false;
    
    public $useDateRange = false;
    
    public $useSearch = false;
    
    public $useStatus = false;
    
    public $useType = false;

    public $useDownload = false;
    
    public function mount($table, $positionType = null)
    {
        if (request()->input('dateType')) {
            $this->dateType = request()->input('dateType');
        }

        $this->organizations = Organization::select(['id', 'name'])->orderByDefault()->get();
        $this->teams = Contact::classTeam()->select(['id', 'name'])->get();
        $this->callers = Contact::selectFullName()->get();
        $this->agents = Contact::classPerson()->selectFullName()->get();
        $this->types = Constants::TICKET_TYPES;
        $this->statusTicketRequest = status_ticket_request();
        $this->statusTicketIncident = status_ticket_incident();
        $this->statusTicketProblem = status_ticket_problem();
        $this->statusTicketChange = status_ticket_change();
        $this->table = $table;

    }

    public function render()
    {
        return view('livewire.utils.filter');
    }
}
