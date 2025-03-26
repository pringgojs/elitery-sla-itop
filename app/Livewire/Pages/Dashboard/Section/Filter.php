<?php

namespace App\Livewire\Pages\Dashboard\Section;

use App\Constants\Constants;
use App\Livewire\Pages\Dashboard\Index;
use Livewire\Component;

class Filter extends Component
{
    public $entitlements = [];

    public $plans = ['small', 'medium', 'large'];

    public $state;

    public $plan;

    public function mount()
    {
        $this->entitlements = Constants::ENTITLEMENTS;
    }

    public function render()
    {
        return view('livewire.pages.dashboard.section.filter');
    }

    public function filter()
    {
        $this->dispatch('filter', state: $this->state, plan: $this->plan)->to(Index::class);
    }

    public function export()
    {
        info('export nya ke triger');
        info('state:'.$this->state);
        info('plan:'.$this->plan);
        $this->dispatch('export', state: $this->state, plan: $this->plan)->to(Index::class);
    }
}
