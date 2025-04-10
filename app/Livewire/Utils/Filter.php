<?php

namespace App\Livewire\Utils;

use App\Models\Seed;
use App\Models\Option;
use App\Models\Contact;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use App\Models\Organization;

class Filter extends Component
{
    public $organizations;

    public $callers;

    public $teams;

    public $agents;

    public $dateType;

    public $table;

    public $params;

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
    
    public $useDownload = false;
    
    public function mount($table, $positionType = null)
    {
        $this->dateType = request()->input('dateType') ? : '';
        $this->organizations = Organization::select(['id', 'name'])->orderByDefault()->get();
        $this->callers = Contact::selectFullName()->get();
        $this->teams = Contact::classTeam()->selectFullName()->get();
        $this->agents = Contact::classPerson()->selectFullName()->get();
        $this->table = $table;
    }

    public function render()
    {
        return view('livewire.utils.filter');
    }
}
