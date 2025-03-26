<?php

namespace App\Livewire\Forms;

use App\Models\DepartmentDetail;
use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepartmentForm extends Form
{
    public $id = ''; // digunakan untuk edit

    // #[Validate('required|max:250')]
    public $name = '';

    // #[Validate('required|max:250')]
    public $location = '';

    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'location' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 250 karakter.',
            'location.required' => 'Lokasi gedung wajib diisi.',
            'location.string' => 'Lokasi gedung harus string.',
        ];
    }

    public function store()
    {
        $this->validate();

        /* simpan jenis desa */
        $payload = [
            'name' => $this->name,
            'type' => 'department',
            'key' => str_replace(' ', '_', strtolower($this->name)),
        ];

        /* proses simpan */
        $model = Option::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        $payload = [
            'department_id' => $model->id,
            'location' => $this->location,
        ];

        /* proses simpan */
        $detail = DepartmentDetail::whereDepartmentId($model->id)->first();
        if ($detail) {
            $detail->delete();
        }

        DepartmentDetail::create($payload);

        return $model;
    }

    public function setModel(Option $option)
    {
        $detail = $option->departmentDetail;

        $this->name = $option->name;
        $this->id = $option->id;
        $this->location = $detail->location ?? '';
    }
}
