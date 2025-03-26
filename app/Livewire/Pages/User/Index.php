<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $isSuperAdmin = false;

    public function mount()
    {
        $this->authorize('user.view');
        $this->isSuperAdmin = auth()->user()->hasRole('Super Admin');
    }

    public function render()
    {
        return view('livewire.pages.user.index', [
            'users' => User::search($this->search)->orderByDefault()->paginate(),
        ]);
    }

    public function delete($id)
    {
        $this->authorize('user.delete');

        $user = User::findOrFail($id);
        if (auth()->user()->id == $id) {
            $this->alert('error', 'You can\'t delete yourself!');
            return;
        }


        $user->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}
