<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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

        $adminUser = User::firstOrCreate(
            ['email' => 'danielpulidorocha2006@gmail.com'],
            [
                'nombre'    => 'Admin',
                'apellido'  => 'Rocha',
                'tipo_id'   => 'Cédula de Ciudadanía',
                'numero_id' => '0000000000',
                'password'  => Hash::make('Io12345#'),
            ]
        );

        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }
    }
}