<?php

namespace App\Livewire\Modals;

use App\Models\Option;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\ActivityTypeForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormActivityType extends ModalComponent
{
    use LivewireAlert;

    public ActivityTypeForm $form;

    public $id;

    public function mount()
    {
        if ($this->id) {
            $model = Option::find($this->id);
            $this->form->setModel($model);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-activity-type');
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
