<?php

namespace App\Livewire\Pages\Role;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $search;

    public function render()
    {
        return view('livewire.pages.role.index', [
            'roles' => Role::paginate(5),
        ]);
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}
