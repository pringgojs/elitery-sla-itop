<?php

namespace Database\Seeders;

use App\Models\Seed;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kayu = \key_option('keras');
        $multi = key_option('produktif');

        $data = [
            [
                'id' => Str::uuid(),
                'name' => 'Jeruk',
                'name_latin' => 'Citrus Sinensis',
                'seed_type_id' => $multi,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Trembesi',
                'name_latin' => 'Kayu',
                'seed_type_id' => $kayu,
            ],[
                'id' => Str::uuid(),
                'name' => 'Alpukat',
                'name_latin' => 'Persea americana',
                'seed_type_id' => $multi,
            ],[
                'id' => Str::uuid(),
                'name' => 'Klengkeng',
                'name_latin' => 'Dimocarpus longan',
                'seed_type_id' => $multi,
            ],[
                'id' => Str::uuid(),
                'name' => 'Aren',
                'name_latin' => 'Arenga pinnata',
                'seed_type_id' => $multi,
            ],[
                'id' => Str::uuid(),
                'name' => 'Tabebuya',
                'name_latin' => 'Tabebuia',
                'seed_type_id' => $kayu,
            ],[
                'id' => Str::uuid(),
                'name' => 'Cemara Laut',
                'name_latin' => 'Casuarina equisetifolia',
                'seed_type_id' => $kayu,
            ],
        ];

        Seed::insert($data);
    }
}
