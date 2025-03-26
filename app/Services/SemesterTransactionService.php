<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\SemesterTransaction;
use App\Models\SemesterTransactionDetail;

class SemesterTransactionService
{
    public $id;
    public $mode;
    public function __construct($goodItems = [], $dateRequired, $id = null, $mode = null)
    {
        $this->id = $id;
        $this->mode = $mode;
        self::store($goodItems, $dateRequired);
    }

    public function store($goodItems = [], $date = null)
    {
        $model = $this->id ? SemesterTransaction::find($this->id) : new SemesterTransaction;
        if (!$this->id) {
            $model->code = $model->generateCode();
            $model->created_by = auth()->user()->id;
            $c = new Carbon($date);
            $model->date_required = $c->format('Y-m-d');
        }
        
        if ($this->mode == 'verification') {
            $model->approved_by = auth()->user()->id;
            $model->approved_at = now();
        }

        $model->department_id = auth()->user()->department_id ?? null;
        $model->save();

        self::createDetail($model, $goodItems);
        return $model;
    }

    public function createDetail($dailyTransaction, $goodItems)
    {
        if ($this->id) {
            SemesterTransactionDetail::where('semester_transaction_id', $this->id)->delete();
        }


        foreach ($goodItems as $item) {
            $model = new SemesterTransactionDetail;
            $model->semester_transaction_id = $dailyTransaction->id;
            $model->is_new = isset($item['isNew']) || isset($item['is_new']) ? true : false;
            if (!isset($item['isNew']) && !isset($item['is_new'])) {
                $model->good_id = isset($item['good_id']) ? $item['good_id'] : $item['id'];
                $model->unit_name = isset($item['unit']['name']) ? $item['unit']['name'] :  $item['unit_name'];
            } else {
                $model->unit_name = isset($item['unit']) ? $item['unit'] :  '';
            }
            $model->good_name = isset($item['name']) ? $item['name'] : $item['good_name']; 
            $model->unit_id = isset($item['unit_id']) ? $item['unit_id'] : null; 
            $model->price_estimate = isset($item['price_estimate']) ? format_price($item['price_estimate']) : 0;
            $model->total = $item['total'];
            $model->note = isset($item['note']) ? $item['note'] : null;
            $model->specification = isset($item['specification']) ? $item['specification'] : null;
            $model->save();
        }
    }

}