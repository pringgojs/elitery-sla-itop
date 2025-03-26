<?php

namespace App\Livewire\Forms;

use App\Models\Good;
use App\Rules\UniqueCodeOfGood;
use App\Services\HistoryTransactionService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GoodForm extends Form
{
    public $id = ''; // digunakan untuk edit

    // #[Validate('required|max:250')]
    public $name = '';

    // #[Validate('required|max:250')]
    public $code = '';

    // #[Validate('required|max:250')]
    public $specification = '';

    // #[Validate('required|string|email')]
    public $unit = '';

    public $isAddStock;

    public $stock;

    public $good;

    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'code' => [
                'required',
                'max:250',
                new UniqueCodeOfGood($this->code, $this->good),
            ],
            'specification' => 'nullable|max:250',
            'unit' => 'required',
            'stock' => $this->isAddStock ? 'required|integer|max:10000' : 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 250 karakter.',
            'code.required' => 'Kode wajib diisi.',
            'code.exist' => 'Kode sudah ada.',
            'code.max' => 'Kode tidak boleh lebih dari 250 karakter.',
            'specification.required' => 'Spesifikasi wajib diisi.',
            'specification.max' => 'Spesifikasi tidak boleh lebih dari 20 karakter.',
            'unit.required' => 'Satuan wajib diisi.',
            'stock.name' => 'Stok barang wajib diisi.',
            'stock.number' => 'Stok barang harus berupa angka.',
            'stock.max' => 'Stok barang maksimal 10000.',
        ];
    }

    public function store()
    {
        $this->validate();

        $payload = [
            'name' => $this->name,
            'unit_id' => $this->unit,
            'code' => $this->code,
            'specification' => $this->specification,
        ];

        /* proses simpan */
        $model = Good::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        if ($this->isAddStock) {
            new HistoryTransactionService($goodId = $model->id, $this->stock, 'in', $refModel = Good::class, $refId = $model->id);
        }

        return $model;
    }

    public function setModel(Good $good)
    {
        $this->good = $good; // untuk validasi email unique

        $this->id = $good->id;
        $this->name = $good->name;
        $this->code = $good->code;
        $this->unit = $good->unit_id;
        $this->specification = $good->specification;
    }
}
