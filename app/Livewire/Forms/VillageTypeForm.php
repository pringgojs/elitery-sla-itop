<?php

namespace App\Livewire\Forms;

use App\Models\Option;
use App\Models\VillageTypeDetail;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VillageTypeForm extends Form
{
    public $id = ''; // digunakan untuk edit

    // #[Validate('required|max:250')]
    public $name = '';

    // #[Validate('required|max:250')]
    public $maxKasi = '';

    // #[Validate('required|max:250')]
    public $maxKaur = '';

    public $villageType;

    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'maxKasi' => 'required|integer|max:5',
            'maxKaur' => 'required|integer|max:5',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 250 karakter.',
            'maxKasi.required' => 'Maksimal jumlah kasi wajib diisi.',
            'maxKasi.max' => 'Maksimal jumlah kasi tidak boleh lebih dari 5.',
            'mamaxKaurxKasi.required' => 'Maksimal jumlah kaur wajib diisi.',
            'maxKaur.max' => 'Maksimal jumlah kaur tidak boleh lebih dari 5.',
        ];
    }

    public function store()
    {
        $this->validate();

        /* simpan jenis desa */
        $payload = [
            'name' => $this->name,
            'type' => 'village_type',
            'key' => str_replace(' ', '_', strtolower($this->name)),
        ];

        /* proses simpan */
        $model = Option::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        $payload = [
            'type_id' => $model->id,
            'max_kasi' => $this->maxKasi,
            'max_kaur' => $this->maxKaur,
        ];

        /* proses simpan */
        $detail = VillageTypeDetail::whereTypeId($model->id)->first();
        if ($detail) {
            $detail->delete();
        }

        VillageTypeDetail::create($payload);

        return $model;
    }

    public function setModel(Option $option)
    {
        $detail = $option->villageTypeDetail;

        $this->name = $option->name;
        $this->id = $option->id;
        $this->maxKasi = $detail->max_kasi ?? '';
        $this->maxKaur = $detail->max_kaur ?? '';
    }
}
