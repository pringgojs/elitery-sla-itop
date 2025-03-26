<?php

namespace App\Services;

use App\Models\DailyTransaction;
use App\Models\DailyTransactionDetail;

class DailyTransactionService
{
    public $id;
    public $mode;
    public function __construct($goodItems = [], $id = null, $mode = null)
    {
        $this->id = $id;
        $this->mode = $mode;
        self::store($goodItems);
    }

    public function store($goodItems = [])
    {
        $model = $this->id ? DailyTransaction::find($this->id) : new DailyTransaction;
        if (!$this->id) {
            $model->code = $model->generateCode();
            $model->created_by = auth()->user()->id;
        }
        
        if ($this->mode == 'verification') {
            $model->approved_by = auth()->user()->id;
            $model->approved_at = now();
        }

        $model->department_id = auth()->user()->department_id;
        $model->save();

        self::createDetail($model, $goodItems);
        return $model;
    }

    public function createDetail($dailyTransaction, $goodItems)
    {
        if ($this->id) {
            DailyTransactionDetail::where('daily_transaction_id', $this->id)->delete();
        }
        
        foreach ($goodItems as $item) {
            $model = new DailyTransactionDetail;
            $model->daily_transaction_id = $dailyTransaction->id;
            $model->good_id = isset($item['good_id']) ? $item['good_id'] : $item['id'];
            $model->good_name = isset($item['name']) ? $item['name'] : $item['good_name']; 
            $model->unit_id = isset($item['unit_id']) ? $item['unit_id'] : null; 
            $model->unit_name = isset($item['unit']['name']) ? $item['unit']['name'] :  $item['unit_name'];
            $model->total = $item['total'];
            $model->note = isset($item['note']) ? $item['note'] : null;
            $model->save();
        }
    }

}