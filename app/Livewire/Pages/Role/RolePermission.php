<?php

namespace App\Livewire\Pages\Role;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Component
{
    use LivewireAlert;

    public $role;

    public $permissions;

    protected $listeners = ['refreshComponent' => '$refresh', 'update'];

    public function mount($id)
    {
        $this->role = Role::findOrFail($id);
    }

    public function update($permissionId)
    {
        if ($this->role->hasPermissionTo($permissionId)) {
            $this->role->revokePermissionTo($permissionId);
        } else {
            $this->role->givePermissionTo($permissionId);
        }

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');

    }

    public function render()
    {
        return view('livewire.pages.role.role-permission', [
            'groups' => Permission::select('group')->orderBy('group')->groupBy('group')->get(),
        ]);
    }
}
