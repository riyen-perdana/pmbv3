<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission Dashboard Modul
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);

        //Permission Permission Modul
        Permission::create(['name' => 'permission.index', 'guard_name' => 'web']);

        //Permission Role Modul
        Permission::create(['name' => 'role.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'role.delete', 'guard_name' => 'web']);

        //Permission Role User
        Permission::create(['name' => 'user.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.add', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.update', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.delete', 'guard_name' => 'web']);
    }
}
