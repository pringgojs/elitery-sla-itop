<?php

namespace Database\Seeders;

use App\Imports\VillageImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Excel::import(new VillageImport('pacitan'), storage_path('app/resources/data-pacitan.xlsx'));
        Excel::import(new VillageImport('ponorogo'), storage_path('app/resources/data-ponorogo.xlsx'));
    }
}
