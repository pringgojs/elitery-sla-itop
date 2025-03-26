<?php

namespace App\Exports;

use App\Models\DailyTransaction;
use App\Models\DailyTransactionDetail;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyTransactionDetailExport implements FromCollection, WithHeadings, WithMapping
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
        $transaction = DailyTransaction::search($this->search)->status($this->status)->date($this->dateType, $this->params)->select('id')->orderByDefault()->pluck('id');
        return DailyTransactionDetail::whereIn('daily_transaction_id', $transaction)->with(['dailyTransaction', 'good', 'unit'])->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Transaksi',
            'Tanggal dibuat',
            'Dibuat oleh',
            'Unit/Sie',
            'Status',
            'Nama Barang',
            'Satuan',
            'Jumlah',
        ];
    }

    public function map($detail): array
    {
        return [
            ++$this->i,
            $detail->dailyTransaction->code,
            $detail->dailyTransaction->created_at,
            $detail->dailyTransaction->creator->name,
            ucwords(strtolower($detail->dailyTransaction->creator->department->name ?? '')),
            $detail->dailyTransaction->approved_by ? 'selesai': 'menunggu diproses',
            $detail->good_name ?? '',
            $detail->unit_name ?? '',
            $detail->total,
        ];
    }
}
