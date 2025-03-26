<?php

namespace App\Livewire\Pages\PlantingActivity\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use Livewire\Attributes\Computed;

class FormStep1 extends Component
{
    public $form;

    public $activityTypes;
    public $regencies;
    public $districts;
    public $villages = [];
    public $regencyId;
    
    public function mount()
    {
        // dd($this->form);
        $this->activityTypes = Option::activityTypes()->get();
        $this->regencies = Option::regencies()->get();
        $this->districts = District::orderByDefault()->get();
        $this->villages = Village::orderByDefault()->get();
    }

    public function getDistrict($id)
    {
        $this->districts = District::regencyId($id)->orderByDefault()->get();
    }

    public function getVillage($id)
    {
        $this->villages = Village::districtId($id)->orderByDefault()->get();
    }

    public function render()
    {
        return view('livewire.pages.planting-activity.section.form-step1');
    }
}
