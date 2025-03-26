<?php

namespace App\Livewire\Modals;

use App\Models\Option;
use Livewire\Component;
use App\Models\PlantingActivity;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class DetailPlantingActivity extends ModalComponent
{
    public $plantingActivity;

    public $id;

    public function mount()
    {
        info('id clik marker');
        // info($this->id);
        // $this->plantingActivity = PlantingActivity::with(['creator', 'activityType', 'regency', 'district', 'village', 'seedSource', 'budgetSource', 'seeds'])->whereId($this->id)->first();
    }

    public function render()
    {
        return view('livewire.modals.detail-planting-actitvity');
    }

    /* Modal */
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
