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
    }

    public function permission()
    {
        $group = 'Menu';
        $permissions = PermissionService::create($group, ['ticket', 'report', 'management user']);
        $group = 'User';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Role';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete', 'permission']);
        $group = 'Permission';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete']);
        $group = 'Ticket';
        $permissions = PermissionService::create($group, ['view', 'recalculate', 'export']);
    }
}
