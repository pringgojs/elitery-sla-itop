<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\GoodForm;
use App\Models\Good;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FormGood extends ModalComponent
{
    use LivewireAlert;

    public GoodForm $form;

    public $units;

    public $types;

    public $id;

    public function mount()
    {
        $this->units = Option::units()->get();
        if ($this->id) {
            $model = Good::find($this->id);
            $this->form->setModel($model);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-good');
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
