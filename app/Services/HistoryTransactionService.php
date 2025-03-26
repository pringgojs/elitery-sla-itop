<?php

namespace App\Services;

use App\Exceptions\AppException;
use App\Models\Good;
use App\Models\HistoryTransaction;
use Illuminate\Support\Str;

class HistoryTransactionService
{
    public $goodId;

    public $unitId;

    public $quantity;

    public $type;

    public $refModel;

    public $refId;

    public function __construct($goodId, $quantity = 0, $type = 'in', $refModel = null, $refId = null)
    {
        $this->goodId = $goodId;
        $this->quantity = $quantity;
        $this->type = $type;
        $this->refModel = $refModel;
        $this->refId = $refId;

        self::create();
    }

    public function create()
    {
        $good = Good::findOrFail($this->goodId);
        $quantity_after = $this->type == 'in' ? $good->total_stock + $this->quantity : $good->total_stock - $this->quantity;

        /* quantity tidak boleh kurang dari 0. */
        if ($quantity_after < 0) {
            throw new AppException($good->name .' stok setelah penambahan atau pengurangan tidak boleh bernilai negatif atau kurang dari 0.');
        }

        $payload = [
            'id' => Str::uuid(),
            'good_id' => $good->id,
            'good_name' => $good->name,
            'unit_name' => $good->unit->name,
            'quantity' => $this->quantity,
            'quantity_before' => $good->total_stock,
            'quantity_after' => $quantity_after,
            'type' => $this->type,
            'reference_type_model' => $this->refModel,
            'reference_type_id' => $this->refId,
            'created_by' => auth()->user()->id,
        ];

        /* add to history */
        HistoryTransaction::create($payload);

        /* update stock */
        $good->total_stock = $quantity_after;
        $good->save();
    }
}
