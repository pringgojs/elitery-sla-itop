<?php

namespace App\Livewire\Pages\Permission;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $search;

    public function render()
    {
        $this->authorize('permission.view');

        return view('livewire.pages.permission.index', [
            'permissions' => Permission::search($this->search)->paginate(5),
        ]);
    }

    public function delete($id)
    {
        $this->authorize('permission.delete');

        $role = Permission::findOrFail($id);
        $role->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}
