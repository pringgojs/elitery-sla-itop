<?php

namespace App\Livewire\Pages\Frontend\Section;

use App\Models\Seed;
use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;

class Filter extends Component
{
    public $regencies;

    public $districts;

    public $villages;

    public $activityTypes;

    public $budgetSources;

    public $seedSources;

    public $seedTypes;

    public $dateType;

    public $table;

    public $params;

    /* use utilitas filter */
    public $useArea = true;

    public $useActivityType = true;

    public $useBudgetSource = true;

    public $useSeedSource = true;

    public $useSeedType = true;

    public $useDate = true;

    public $useDateToday = true;
    
    public $useDateThisMonth = true;
    
    public $useDateOtherMonth = true;

    public $useDateOtherYear = true;
    
    public $useDateRange = true;
    
    public $useSearch = true;
    
    public $useDownload = true;
    
    public function mount()
    {
        $this->dateType = request()->input('dateType') ? : '';
        $this->regencies = Option::regencies()->get();
        $this->districts = District::orderByDefault()->get();
        $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->activityTypes = Option::activityTypes()->get();
        $this->budgetSources = Option::budgetSources()->get();
        $this->seedSources = Option::seedSources()->get();
        $this->seedTypes = Seed::orderByDefault()->get();

        $this->table = 'pages.frontend.section.data';
    }
    
    public function render()
    {
        return view('livewire.pages.frontend.section.filter');
    }
}
