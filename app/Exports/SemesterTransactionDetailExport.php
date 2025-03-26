<?php

namespace App\Exports;

use App\Models\SemesterTransaction;
use App\Models\SemesterTransactionDetail;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SemesterTransactionDetailExport implements FromCollection, WithHeadings, WithMapping
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
        $transaction = SemesterTransaction::search($this->search)->status($this->status)->date($this->dateType, $this->params)->select('id')->orderByDefault()->pluck('id');
        return SemesterTransactionDetail::whereIn('semester_transaction_id', $transaction)->with(['semesterTransaction', 'good', 'unit'])->get();
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
            'Nama Barang',
            'Spesifikasi',
            'Satuan',
            'Jumlah',
            'Perkiraan Harga'
        ];
    }

    public function map($detail): array
    {
        return [
            ++$this->i,
            $detail->semesterTransaction->code,
            $detail->semesterTransaction->created_at,
            date_format_human($detail->semesterTransaction->date_required),
            $detail->semesterTransaction->creator->name,
            ucwords(strtolower($detail->semesterTransaction->creator->department->name ?? '')),
            $detail->semesterTransaction->approved_by ? 'selesai': 'menunggu diproses',
            $detail->good_name ?? '',
            $detail->specification ?? '',
            $detail->unit_name ?? '',
            $detail->total,
            format_rupiah($detail->price_estimate)
        ];
    }
}
