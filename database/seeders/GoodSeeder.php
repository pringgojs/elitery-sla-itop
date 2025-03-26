<?php

namespace Database\Seeders;

use App\Models\Good;
use App\Models\Option;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => Str::uuid(),
                'code' => '1010305012000005',
                'name' => 'Kapur Barus Toilet',
                'specification' => 'Kapur Barus Toilet',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            [
                'id' => Str::uuid(),
                'code' => '1010305012000002',
                'name' => 'Bay Fress Matic',
                'specification' => 'Bay Fress Matic',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            [
                'id' => Str::uuid(),
                'code' => '1010305012000013',
                'name' => 'Refile Bayfres Matic',
                'specification' => 'Refile Bayfres Matic',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            [
                'id' => Str::uuid(),
                'code' => '1010305012000017',
                'name' => 'Pengharum Pakaian',
                'specification' => 'Pengharum Pakaian',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            

            // --
            [
                'id' => Str::uuid(),
                'code' => '1010301003000005',
                'name' => 'Paper Clip Trigonal',
                'specification' => 'Paper Clip Trigonal',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            [
                'id' => Str::uuid(),
                'code' => '1010301003000006',
                'name' => 'Paper Clip Trigonal Besar',
                'specification' => 'Paper Clip Trigonal Besar',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            [
                'id' => Str::uuid(),
                'code' => '1010399999000110',
                'name' => 'Pisau Potong Rumput',
                'specification' => 'Pisau Potong Rumput',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
            [
                'id' => Str::uuid(),
                'code' => '1010306002000041',
                'name' => 'LED Neon 16 watt Komplit',
                'specification' => 'LED Neon 16 watt Komplit',
                'total_stock' => 20,
                'unit_id' => Option::whereType('unit')->first()->id
            ],
        ];

        Good::insert($data);


    }
}
