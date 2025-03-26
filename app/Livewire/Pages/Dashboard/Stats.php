<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\Option;
use Livewire\Component;
use App\Models\DailyTransaction;
use App\Models\SemesterTransaction;

class Stats extends Component
{
    public $stats;

    public function mount()
    {
        $this->stats['total_semester'] = SemesterTransaction::count();
        $this->stats['total_semester_done'] = SemesterTransaction::status(['done'])->count();
        $this->stats['total_semester_pending'] = SemesterTransaction::status(['pending'])->count();
        $this->stats['total_daily'] = DailyTransaction::count();
        $this->stats['total_daily_done'] = DailyTransaction::status(['done'])->count();
        $this->stats['total_daily_pending'] = DailyTransaction::status(['pending'])->count();

        // $this->options = Option::positionTypes()->get();
    }

    public function render()
    {
        return view('livewire.pages.dashboard.stats');
    }
}
