<?php

namespace App\Livewire\Pages\Dashboard\Section;

use App\Models\Option;
use App\Models\VillageStaff;
use Livewire\Component;

class StatStatus extends Component
{
    public $stats;

    public $status_data;

    public function mount()
    {
        $total_staff_retiring_soon = VillageStaff::totalStaffRetiringSoon();
        $total_bpd_retiring_soon = VillageStaff::totalBpdRetiringSoon();
        $this->stats = [
            // 'Jumlah Total Perangkat (Semua Status)' => $total,
            // 'Jumlah Perangkat dengan Status Final' => $total_final,
            'Jumlah Semua Perangkat Kecuali BPD' => $total_staff_retiring_soon,
            'Jumlah Khusus BPD' => $total_bpd_retiring_soon,
        ];

        $this->status_data = Option::statusData()->get();
    }

    public function render()
    {
        return view('livewire.pages.dashboard.section.stat-status');
    }
}
