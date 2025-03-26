<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Village;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DepartmentDetail;
use App\Models\VillageTypeDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::budgetSource();
        self::seedSource();
        self::seedType();
        self::activityType();
        self::regency();
    }

    public function regency()
    {
        $sources = [
            'Ponorogo'
        ];
    
        $data = collect($sources)->map(fn($item) => [
            'id' => Str::uuid(),
            'name' => $item,
            'key' => str_replace(' ', '_', strtolower($item)),
            'type' => 'regency',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data); 
    }

    public function budgetSource()
    {
        $sources = [
            'Swadaya', 'CSR', 'APBD'
        ];
    
        $data = collect($sources)->map(fn($item) => [
            'id' => Str::uuid(),
            'name' => $item,
            'key' => null,
            'type' => 'budget_source',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);

    }

    public function seedSource()
    {
        $items = [
            'PEMBIBITAN SWADAYA',
            'CSR BUMD/BUMN/LAINNYA',
        ];
    
        $data = collect($items)->map(fn($item) => [
            'id' => Str::uuid(),
            'name' => $item,
            'key' => null,
            'type' => 'seed_source',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function seedType()
    {
        $options = [
            'Produktif', 'Keras'];
    
        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'key' => str_replace(' ', '_', strtolower($value)),
            'type' => 'seed_type',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function activityType()
    {
        $options = [
            'Pembibitan Swadaya','Hutan Rakyat', 'CSR', 'Penghijauan Lingkungan',
        ];
    

        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'key' => str_replace(' ', '_', strtolower($value)),
            'type' => 'activity_type',
            'created_at' => now(),
            'updated_at' => now(),
            'extra' => serialize(['color' => generate_hex_color()])
        ])->toArray();
    
        Option::insert($data);
    }
}
