<?php

namespace App\Exports;

use App\Models\PlantingActivity;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlantingActivityExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PlantingActivity::filter($this->params)->with(['regency', 'district', 'village', 'activityType'])->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Tanggal',
            'Petugas',
            'Jenis Kegiatan',
            'Pelaksana Kegiatan',
            'Kabupaten',
            'Kecamatan',
            'Desa',
            'Dukuh',
            'Luas Lahan (Ha)',
            'Sumber Dana',
            'Sumber Bibit',
        ];
    }

    public function map($item): array
    {
        return [
            ++$this->i,
            date_format_human($item->date_of_activity),
            $item->creator->name ?? '-',
            $item->activityType->name ?? '-',
            $item->activity_organizer,
            $item->regency->name,
            $item->district->name,
            $item->village->name,
            $item->area_detail,
            $item->land_area,
            $item->budgetSource->name ?? '',
            $item->seedSource->name ?? '',
        ];
    }
}
