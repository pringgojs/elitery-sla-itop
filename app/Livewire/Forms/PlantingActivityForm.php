<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Support\Carbon;
use App\Models\PlantingActivity;
use Livewire\Attributes\Validate;
use App\Models\PlantingActivitySeed;
use App\Services\StoreImgFromBase64;

class PlantingActivityForm extends Form
{
    public $dateTime;
    public $activityTypeId;
    public $activityOrganizer;
    public $regencyId;
    public $districtId;
    public $villageId;
    public $areaDetail;
    public $seeds;
    public $seedSourceId;
    public $budgetSourceId;
    public $landArea;
    public $picName;
    public $activityNote;
    public $activityImage;
    public $imagePreview;
    public $latitude;
    public $longitude;
    public $isSubmit;

    public $id;
    

    public function rules()
    {
        return [
            'dateTime' => 'required',
            'activityTypeId' => 'required',
            'activityOrganizer' => 'required',
            'regencyId' => 'required',
            'districtId' => 'required',
            'villageId' => 'required',
            'areaDetail' => 'required',
            'seeds' => 'required',
            'seedSourceId' => 'required',
            'budgetSourceId' => 'required',
            'landArea' => 'required',
            'picName' => 'required',
            'activityNote' => 'required',
            'activityImage' => 'nullable', // set to nullable
            'latitude' => 'required',
            'longitude' => 'required',
            'isSubmit' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'dateTime.required' => 'Lengkapi semua kolom yang kosong',
            'activityTypeId.required' => 'Lengkapi semua kolom yang kosong',
            'activityOrganizer.required' => 'Lengkapi semua kolom yang kosong',
            'regencyId.required' => 'Lengkapi semua kolom yang kosong',
            'districtId.required' => 'Lengkapi semua kolom yang kosong',
            'villageId.required' => 'Lengkapi semua kolom yang kosong',
            'areaDetail.required' => 'Lengkapi semua kolom yang kosong',
            'seeds.required' => 'Lengkapi semua kolom yang kosong',
            'seedSourceId.required' => 'Lengkapi semua kolom yang kosong',
            'budgetSourceId.required' => 'Lengkapi semua kolom yang kosong',
            'landArea.required' => 'Lengkapi semua kolom yang kosong',
            'picName.required' => 'Lengkapi semua kolom yang kosong',
            'activityNote.required' => 'Lengkapi semua kolom yang kosong',
            'activityImage.required' => 'Lengkapi semua kolom yang kosong',
            'latitude.required' => 'Lengkapi semua kolom yang kosong',
            'longitude.required' => 'Lengkapi semua kolom yang kosong',
            'isSubmit.required' => 'Lengkapi semua kolom yang kosong',
        ];
    }

    public function store($form)
    {
        $payload = [
            'created_by' => auth()->user()->id,
            'activity_type_id' => $form['activityTypeId'],
            'activity_organizer' => $form['activityOrganizer'],
            'regency_id' => $form['regencyId'],
            'district_id' => $form['districtId'],
            'village_id' => $form['villageId'],
            'area_detail' => $form['areaDetail'],
            'seed_source_id' => $form['seedSourceId'],
            'budget_source_id' => $form['budgetSourceId'],
            'land_area' => format_price($form['landArea']),
            'pic_name' => $form['picName'],
            'activity_note' => $form['activityNote'],
            'latitude' => $form['latitude'],
            'longitude' => $form['longitude'],
            'date_of_activity' => $form['dateTime']
        ];

        if ($form['activityImage']) {
            /* jika ktp is string, maka data ktp di load dari DB, kalau bukan, berarti dari Object Livewire Upload */
            if (is_string($form['activityImage'])) {
                /* remove old file */
                // if ($form['activityImage']_old) {
                    // ktp/QnvSbHox97cW0RChaEOI1pmRB6xJJLgAI6k1qAIr.png
                    // Storage::delete('public/'.$form['activityImage']_old);
                // }

                $service = new StoreImgFromBase64;
                $path = $service->store($form['activityImage'], 'img', 'public');
                $payload['activity_image'] = $path;
            }
        }

        /* proses simpan */
        $model = PlantingActivity::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        if ($form['seeds']) {
            self::insertDetail($form, $model);
        }

        return $model;
    }

    public function insertDetail($form, $model)
    {
        if (!$form['seeds']) return;

        if ($this->id) {
            PlantingActivitySeed::where('planting_activity_id', $this->id)->delete();
        }

        if (count($form['seeds']) > 0) {
            foreach ($form['seeds'] as $key => $item) {
                $seed = new PlantingActivitySeed;
                $seed->planting_activity_id = $model->id;
                $seed->seed_id = $item['id'];
                $seed->amount = format_price($item['amount']);
                $seed->save();
            }

        }
    }

    public function setModel($form = null)
    {
        if ($form->date_of_activity) {
            $dt = new Carbon($form->date_of_activity);
            $dt = $dt->format('Y-m-d');
        }
        $this->id = $form->id;
        $this->dateTime = $form->date_of_activity ? $dt : date('Y-m-d');
        $this->activityTypeId = $form->activity_type_id;
        $this->activityOrganizer = $form->activity_organizer;
        $this->regencyId = $form->regency_id;
        $this->districtId = $form->district_id;
        $this->villageId = $form->village_id;
        $this->areaDetail = $form->area_detail;
        $this->seeds = $form->seeds ? self::seedMap($form->seeds) : [];
        $this->seedSourceId = $form->seed_source_id;
        $this->budgetSourceId = $form->budget_source_id;
        $this->landArea = $form->land_area;
        $this->picName = $form->pic_name;
        $this->activityNote = $form->activity_note;
        $this->imagePreview = $form->activity_image ? asset('storage/'.$form->activity_image) : null;
        $this->latitude = $form->latitude;
        $this->longitude = $form->longitude;
        $this->isSubmit = false;
    }

    public function seedMap($seeds = [])
    {
        if (!$seeds) return [];
        return $seeds->map(function ($seed) {
            return [
                'id' => $seed->seed_id,
                'name' => $seed->seed->name, // Mengakses nama dari relasi table seeds
                'amount' => $seed->amount,
            ];
        });
    }
}
