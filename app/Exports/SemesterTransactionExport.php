<?php

namespace App\Exports;

use App\Models\SemesterTransaction;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SemesterTransactionExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $params;
    public $search;
    public $status;
    public $dateType;
    public $month;
    public $year;

    public function __construct($params = [])
    {
        $this->params = $params;

        $this->search = isset($params['search']) ? $params['search'] : null;
        $this->status = isset($params['status']) ? $params['status'] : [];
        $this->dateType = isset($params['dateType']) ? $params['dateType'] : null;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SemesterTransaction::search($this->search)->status($this->status)->date($this->dateType, $this->params)->with(['details.good', 'creator', 'approver'])->orderByDefault()->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Transaksi',
            'Tanggal dibuat',
            'Tanggal dibutuhkan',
            'Dibuat oleh',
            'Unit/Sie',
            'Status',
            'Disetujui oleh',
            'Tanggal Disetujui',
            'Jumlah Barang'
        ];
    }

    public function map($transaction): array
    {
        return [
            ++$this->i,
            $transaction->code,
            $transaction->created_at,
            date_format_human($transaction->date_required),
            $transaction->creator->name,
            ucwords(strtolower($transaction->creator->department->name ?? '')),
            $transaction->approved_by ? 'selesai': 'menunggu diproses',
            $transaction->approver->name ?? '',
            $transaction->approved_at,
            $transaction->details->count()
        ];
    }
}
