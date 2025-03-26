<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\RoleForm;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class FormRole extends ModalComponent
{
    use LivewireAlert;

    public RoleForm $form;

    public $id;

    public function mount()
    {
        if ($this->id) {
            $model = Role::find($this->id);
            $this->form->setModel($model);
        }
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

    public function render()
    {
        return view('livewire.modals.form-role');
    }
}
