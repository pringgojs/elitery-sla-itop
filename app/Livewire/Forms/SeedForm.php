<?php

namespace App\Livewire\Forms;

use App\Models\Seed;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SeedForm extends Form
{
    public $id = ''; // digunakan untuk edit

    #[Validate('required|max:250')]
    public $name = '';

    #[Validate('required|max:250')]
    public $name_latin = '';

    #[Validate('required|max:250')]
    public $seed_type_id = '';

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name_latin.required' => 'Nama latin wajib diisi.',
            'seed_type_id.required' => 'Jenis bibit wajib diisi.',
        ];
    }

    public function store()
    {
        $this->validate();

        /* simpan jenis desa */
        $payload = [
            'name' => $this->name,
            'name_latin' => $this->name_latin,
            'seed_type_id' => $this->seed_type_id,
        ];

        /* proses simpan */
        $model = Seed::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        return $model;
    }

    public function setModel(Seed $seed)
    {
        $this->id = $seed->id;
        $this->name = $seed->name;
        $this->name_latin = $seed->name_latin;
        $this->seed_type_id = $seed->seed_type_id;
    }
}
