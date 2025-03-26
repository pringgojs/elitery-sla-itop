<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\VillageForm;
use App\Models\Option;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FormVillage extends ModalComponent
{
    use LivewireAlert;

    public VillageForm $form;

    public $districts;

    public $types;

    public $id;

    public function mount()
    {
        $this->districts = Option::districts()->get();
        $this->types = Option::villageTypes()->get();
        if ($this->id) {
            $model = Village::find($this->id);
            $this->form->setModel($model);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-village');
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();

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
