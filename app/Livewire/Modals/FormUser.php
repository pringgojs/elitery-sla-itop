<?php

namespace App\Livewire\Modals;

use App\Models\User;
use App\Models\Option;
use Livewire\Component;
use App\Livewire\Forms\UserForm;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormUser extends ModalComponent
{
    use LivewireAlert;

    public UserForm $form;

    public $roles;

    public $user_id;

    public $isSuperAdmin = false;

    public function mount()
    {
        $this->isSuperAdmin = auth()->user()->hasRole('Super Admin');
        $this->roles = Role::all();
        if ($this->user_id) {
            $user = User::find($this->user_id);
            $this->form->setModel($user);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-user');
    }

    public function store()
    {
        DB::beginTransaction();

        $user = $this->form->store();

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
