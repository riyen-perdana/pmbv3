<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Akademik']);
        Role::create(['name' => 'Keuangan']);
        Role::create(['name' => 'PTIPD']);
        Role::create(['name' => 'Rektor']);
        Role::create(['name' => 'Wakil Rektor II']);
        Role::create(['name' => 'Dekan']);
    }
}
