<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Tooltip extends Component
{
    public $id;

    public $title;

    public function mount($id = null, $title = null)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.utils.tooltip');
    }
}
