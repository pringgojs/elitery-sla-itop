<?php

namespace App\Exports;

use App\Models\Option;
use App\Models\Village;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StatisticVillageStaffStatusDataExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $search;

    public $district;

    public $statusData;

    public function __construct($params = [])
    {
        if (isset($params['district'])) {
            $this->district = $params['district'];
        }

        if (isset($params['search'])) {
            $this->search = $params['search'];
        }

        $this->statusData = Option::statusData()->orderByDefault()->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Village::with(['district:id,name', 'type'])->search($this->search)->district($this->district)->orderByDefault()->get();
    }

    public function headings(): array
    {
        $array = ['#', 'Desa'];
        foreach ($this->statusData as $item) {
            $array[] = $item->name;
        }

        $array[] = 'Total';

        return $array;
    }

    public function map($village): array
    {
        $array = [
            ++$this->i,
            $village->name,
        ];
        $total = 0;
        foreach ($this->statusData as $status) {
            $count = $village->totalStaffByStatus($status->id);
            $total += $count;

            $array[] = $count;
        }

        $array[] = $total;

        return $array;
    }
}
