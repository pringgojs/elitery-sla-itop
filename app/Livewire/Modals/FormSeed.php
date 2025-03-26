<?php

namespace App\Livewire\Modals;

use App\Models\Seed;
use App\Models\Option;
use Livewire\Component;
use App\Livewire\Forms\SeedForm;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormSeed extends ModalComponent
{
    use LivewireAlert;

    public SeedForm $form;

    public $seedTypes;

    public $id;

    public function mount()
    {
        $this->seedTypes = Option::seedTypes()->get();
        if ($this->id) {
            $model = Seed::find($this->id);
            $this->form->setModel($model);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-seed');
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
