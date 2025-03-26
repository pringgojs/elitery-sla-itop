<?php

namespace App\Exports;

use App\Models\VillageStaff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VillageStaffExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $search;

    public $type;

    public $status;

    public $isActive;

    public $village;

    public $district;

    public $isWillRetire;

    public function __construct($params = [])
    {
        if (isset($params['district'])) {
            $this->district = $params['district'];
        }

        if (isset($params['type'])) {
            $this->type = $params['type'];
        }

        if (isset($params['village'])) {
            $this->village = $params['village'];
        }

        if (isset($params['status'])) {
            $this->status = $params['status'];
        }

        if (isset($params['search'])) {
            $this->search = $params['search'];
        }

        if (isset($params['isWillRetire'])) {
            $this->isWillRetire = $params['isWillRetire'];
        }

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VillageStaff::search($this->search)
            ->district($this->district)
            ->village($this->village)
            ->type($this->type)
            ->pensiun($this->isWillRetire)
            ->activeStatus($this->isActive, $this->status)
            ->with(['village', 'positionType'])
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Jenis Kelamin',
            'Jenis Jabatan',
            'Nama Jabatan',
            'Desa',
            'Kecamatan',
            'No. HP',
            'Email',
            'Alamat',
            'No. SK',
            'TMT. SK',
            'Tanggal SK',
            'Status Data',
            'Tanggal Pensiun',
        ];
    }

    public function map($staff): array
    {
        return [
            ++$this->i,
            $staff->name,
            $staff->gender ? 'L' : 'P',
            $staff->positionType->name,
            $staff->position_name,
            $staff->village->name,
            $staff->village->district->name,
            $staff->phone_number,
            $staff->user->email,
            $staff->address,
            $staff->sk_number,
            $staff->sk_tmt,
            $staff->sk_date,
            $staff->dataStatus->name,
            $staff->date_of_pensiun,
        ];
    }
}
