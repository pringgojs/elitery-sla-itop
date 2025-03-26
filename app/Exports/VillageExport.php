<?php

namespace App\Exports;

use App\Models\Village;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VillageExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $search;

    public $type;

    public $district;

    public function __construct($params = [])
    {
        if (isset($params['district'])) {
            $this->district = $params['district'];
        }

        if (isset($params['type'])) {
            $this->type = $params['type'];
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
        return Village::search($this->search)->type($this->type)->district($this->district)->orderByDefault()->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Desa',
            'Kecamatan',
            'Alamat',
            'Jenis Desa',
            'No. SOTK',
        ];
    }

    public function map($item): array
    {
        return [
            ++$this->i,
            $item->name,
            $item->district->name ?? '',
            $item->type->name ?? '',
            $item->address,
            $item->no_sotk,
        ];
    }
}
