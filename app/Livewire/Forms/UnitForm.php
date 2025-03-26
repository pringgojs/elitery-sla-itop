<?php

namespace App\Livewire\Forms;

use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    public $id = ''; // digunakan untuk edit

    #[Validate('required|max:250')]
    public $name = '';

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
        ];
    }

    public function store()
    {
        $this->validate();

        /* simpan jenis desa */
        $payload = [
            'name' => $this->name,
            'type' => 'unit',
            'key' => null,
        ];

        /* proses simpan */
        $model = Option::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        return $model;
    }

    public function setModel(Option $option)
    {
        $this->id = $option->id;
        $this->name = $option->name;
    }
}
