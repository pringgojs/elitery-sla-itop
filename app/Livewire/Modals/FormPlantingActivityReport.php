<?php

namespace App\Livewire\Modals;

use App\Models\Report;
use Livewire\Component;
use App\Models\PlantingActivity;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Forms\PlantingActivityReportForm;

class FormPlantingActivityReport extends ModalComponent
{
    use LivewireAlert;

    public PlantingActivityReportForm $form;

    public $id;
    
    public $plantingActivityId;

    public $plantingActivity;

    public function mount()
    {
        $this->plantingActivity = PlantingActivity::findOrFail($this->plantingActivityId);
        $this->form->setPlantingActivityId($this->plantingActivityId);

        if ($this->id) {
            $report = Report::findOrFail($this->id);
            $this->form->setModel($report);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-planting-activity-report');
    }

    public function store()
    {
        DB::beginTransaction();

        $this->form->store();

        DB::commit();

        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger

        $this->closeModal();
    }

    /* Modal */
    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
