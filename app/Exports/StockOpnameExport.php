<?php

namespace App\Exports;

use App\Models\Good;
use App\Models\HistoryTransaction;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockOpnameExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $params;
    public $search;
    public $status;
    public $dateType;
    public $month;
    public $year;

    public $histories;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->search = isset($params['search']) ? $params['search'] : null;
        $this->status = isset($params['status']) ? $params['status'] : [];
        $this->dateType = isset($params['dateType']) ? $params['dateType'] : null;
        self::collectHistory();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Good::search($this->search)->with('unit')->orderByDefault()->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Barang',
            'Nama Barang',
            'Spesifikasi Barang',
            'Satuan',
            'Stok Sekarang',
            'Jumlah Barang Keluar'
        ];
    }

    public function map($item): array
    {
        $total = $this->totalItem($item->id);
        return [
            ++$this->i,
            $item->code,
            $item->name,
            $item->specification,
            $item->unit->name,
            $item->total_stock,
            $total['out'] ?? 0
        ];
    }

    public function collectHistory()
    {
        // mengambil data dalam bulan tertentu di history transaction
        $this->histories = HistoryTransaction::date($this->dateType, $this->params)->select(['good_id', 'quantity', 'quantity_before', 'quantity_after', 'type', 'created_at'])->orderBy('created_at', 'asc')->get();
    }

    public function totalItem($id)
    {
        $filter_in = $this->histories->filter(function ($item, $key) use ($id) {
            return $item->good_id == $id && $item->type == 'in';
        });

        $filter_out = $this->histories->filter(function ($item, $key) use ($id) {
            return $item->good_id == $id && $item->type == 'out';
        });

        $total_out = $filter_out->sum('quantity');
        $total_in = $filter_in->sum('quantity');
        
        // total data keseluruhan adalah total in + total quantity before di baris pertama.
        $first = $this->histories->first();
        $quantity_before = $first ? $first->quantity_before : 0; 
        $total_stock = $total_in + $quantity_before;

        return [
            'stock' => $total_stock,
            'out' => $total_out
        ];
    }
}
