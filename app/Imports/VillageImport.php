<?php

namespace App\Imports;

use App\Models\Option;
use App\Models\Village;
use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class VillageImport implements ToCollection
{
    public $regencyId;
    
    public function __construct($regency) {
        $this->regencyId = key_option($regency);
    }

    public function collection(Collection $collection)
    {
        // 0 => "KECAMATAN"
        // 1 => "DESA"
        foreach ($collection as $i => $item) {
            if ($i == 0) {
                continue;
            }

            $district_name = $item[0];
            $village_name = ucwords(strtolower($item[1]));

            $district = District::search($district_name)->first();
            if (!$district) {
                $district = District::create([
                    'id' => Str::uuid(),
                    'name' => ucwords(strtolower($district_name)),
                    'regency_id' => $this->regencyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $data = [
                'id' => Str::uuid(),
                'name' => $village_name,
                'district_id' => $district->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Village::create($data);
        }
    }
}
