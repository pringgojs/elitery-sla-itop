<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Services\PermissionService;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::permission();
        self::roleGivePermission();
    }

    public function permission()
    {
        $group = 'Menu';
        $permissions = PermissionService::create($group, ['master', 'kegiatan penanaman pohon', 'laporan', 'manajemen user']);
        $group = 'User';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Role';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete', 'permission']);
        $group = 'Permission';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Sumber Anggaran';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Sumber Bibit';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Jenis Bibit';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Jenis Kegiatan';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Kegiatan Penanaman Pohon';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete', 'export', 'add report', 'edit report', 'delete report']);
        $group = 'Laporan';
        $permissions = PermissionService::create($group, ['view', 'export']);
    }

    public function roleGivePermission()
    {
        $role = Role::where('name','Petugas')->first();
        $keywords = ['kegiatan.penanaman', 'laporan'];

        foreach ($keywords as $key => $value) {
            $permissions = Permission::whereLike('name', '%'.$value.'%')->get();
            foreach ($permissions as $item) {
                $role->givePermissionTo($item->name);
            }
        }
    }
}
