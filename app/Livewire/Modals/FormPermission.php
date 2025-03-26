<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\PermissionForm;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class FormPermission extends ModalComponent
{
    use LivewireAlert;

    public PermissionForm $form;

    public $id;

    public $groups;

    public function mount()
    {
        $this->groups = Permission::whereNotNull('group')->select('group')->groupBy('group')->get();
        if ($this->id) {
            $model = Permission::find($this->id);
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
        return view('livewire.modals.form-permission');
    }
}
