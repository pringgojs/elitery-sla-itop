<?php

namespace App\Livewire\Pages\Frontend;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.frontend.index')->layout('components.layouts.guest');
    }
}
