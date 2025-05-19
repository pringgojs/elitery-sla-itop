<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class TreemapChart extends Component
{
    #[Reactive]
    public $title;

    #[Reactive]
    public $label = [];

    #[Reactive]
    public $series = [];

    public $id;

    public $listener;
    public function render()
    {
        return view('livewire.utils.treemap-chart');
    }
}
