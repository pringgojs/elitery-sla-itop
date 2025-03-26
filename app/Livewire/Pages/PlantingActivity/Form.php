<?php

namespace App\Livewire\Pages\PlantingActivity;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PlantingActivity;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\PlantingActivityForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends Component
{
    use LivewireAlert;

    public PlantingActivityForm $form;

    public $plantingActivity;

    public $id;

    public function mount()
    {
        $plantingActivity = $this->id ? PlantingActivity::find($this->id) : new PlantingActivity;
        $this->form->setModel($plantingActivity); 
    }

    public function render()
    {
        return view('livewire.pages.planting-activity.form');
    }

    #[On('store')]
    public function store($form)
    {
        // dd($form);
        DB::beginTransaction();
        
        $this->form->store($form);
        
        DB::commit();
        
        $this->alert('success', 'Success!');
        
        $this->redirectRoute('planting-activity.index', navigate: false);
    }
}
