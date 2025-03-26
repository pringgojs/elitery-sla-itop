<?php

namespace App\Livewire\Pages\PlantingActivity\Section;

use App\Models\Option;
use Livewire\Component;

class FormStep3 extends Component
{
    public $form;

    public $seedSources;
    public $budgetSources;
    public $districts;
    public $villages;
    public $regencyId;
    public $modalPreview = false;
    public $markers = [];
    
    public function mount()
    {
        $this->seedSources = Option::seedSources()->get();
        $this->budgetSources = Option::budgetSources()->get();
        // $this->districts = District::orderByDefault()->get();

        if ($this->form->latitude && $this->form->longitude) {
            $this->markers = [['lat' => $this->form->latitude, 'lng' => $this->form->longitude]];
        }
    }

    public function render()
    {
        return view('livewire.pages.planting-activity.section.form-step3');
    }
}
