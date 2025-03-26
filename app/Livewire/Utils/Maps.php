<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Maps extends Component
{
    public $markers = [];

    public $useOnClickMarker = false;

    public function render()
    {
        return view('livewire.utils.maps');
    }
}
