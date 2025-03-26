<?php

namespace App\Exports;

use App\Models\Village;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StatisticVillageStaffPensiunExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $search;

    public $district;

    public function __construct($params = [])
    {
        if (isset($params['district'])) {
            $this->district = $params['district'];
        }

        if (isset($params['search'])) {
            $this->search = $params['search'];
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Village::with(['district:id,name'])->withCount('staff')->search($this->search)->district($this->district)->orderByDefault()->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Desa',
            'Total Perangkat Desa',
            'Total Perangkat Mau Pensiun dalam 6 Bulan',
            'BPD Mau Pensiun dalam 6 Bulan',
        ];
    }

    public function map($village): array
    {
        return [
            ++$this->i,
            $village->name,
            $village->staff_count ?? 0,
            $village->totalStaffRetiringSoon() ?? 0,
            $village->totalBpdRetiringSoon() ?? 0,
        ];
    }
}
