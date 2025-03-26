<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;

class PieChart extends Component
{
    #[Reactive]
    public $title;

    #[Reactive]
    public $legend = [];

    #[Reactive]
    public $series = [];

    public $id;

    public $listener;

    public function render()
    {
        return view('livewire.utils.pie-chart');
    }
}
