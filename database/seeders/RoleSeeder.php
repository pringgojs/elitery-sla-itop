<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::role();
    }
    
    public function role()
    {
        $roles = ['Super Admin', 'Petugas'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
