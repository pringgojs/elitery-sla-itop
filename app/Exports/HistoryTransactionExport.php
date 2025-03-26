<?php

namespace App\Exports;

use App\Models\HistoryTransaction;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class HistoryTransactionExport implements FromCollection, WithHeadings, WithMapping
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
        return HistoryTransaction::search($this->search)->date($this->dateType, $this->params)->types($this->status)->with(['good', 'creator'])->orderByDefault()->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Satuan',
            'Tanggal',
            'Status',
            'Dibuat oleh',
            'Unit/Sie',
            'Referensi'
        ];
    }

    public function map($transaction): array
    {
        return [
            ++$this->i,
            $transaction->good_code,
            $transaction->good_name,
            $transaction->quantity,
            $transaction->unit_name,
            $transaction->created_at,
            $transaction->type == 'in' ? 'masuk' : 'keluar',
            $transaction->creator->name,
            ucwords(strtolower($transaction->creator->department->name ?? '')),
            $transaction->ref('string')
        ];
    }
}
