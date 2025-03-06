<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'Administrador']);
        $userRole = Role::create(['name' => 'Usuario']);

        // Definir permisos
        $permissions = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'gestionar roles',
            'gestionar permisos',
        ];

        foreach ($permissions as $permiso) {
            $p = Permission::create(['name' => $permiso]);
            $adminRole->givePermissionTo($p); // Dar todos los permisos al Admin
        }

        // Asignar rol de Administrador a un usuario específico
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole($adminRole);
        }
    }
}
