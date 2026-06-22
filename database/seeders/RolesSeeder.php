<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'ver citas']);
        Permission::firstOrCreate(['name' => 'crear citas']);
        Permission::firstOrCreate(['name' => 'cancelar citas']);
        Permission::firstOrCreate(['name' => 'ver usuarios']);
        Permission::firstOrCreate(['name' => 'eliminar usuarios']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user  = Role::firstOrCreate(['name' => 'user']);

        $admin->givePermissionTo(['ver citas','crear citas','cancelar citas','ver usuarios','eliminar usuarios']);
        $user->givePermissionTo(['ver citas','crear citas','cancelar citas']);
    }
}