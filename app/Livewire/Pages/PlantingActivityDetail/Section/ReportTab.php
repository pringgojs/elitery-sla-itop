<?php

namespace App\Livewire\Pages\PlantingActivityDetail\Section;

use App\Models\Report;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ReportTab extends Component
{
    use LivewireAlert;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $form;

    public $modalConfirmDelete = false;

    #[Computed]
    public function items()
    {
        return Report::plantingActivityId($this->form->id)->with(['plantingActivity'])->orderByDefault()->paginate();
    }

    public function render()
    {
        return view('livewire.pages.planting-activity-detail.section.report-tab');
    }
    
    public function delete($id)
    {
        $this->authorize('kegiatan.penanaman.pohon.delete');
        $model = Report::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}
