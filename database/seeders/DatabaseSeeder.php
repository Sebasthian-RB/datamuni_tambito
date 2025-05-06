<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Crear permisos básicos
        $permissions = ['crear', 'editar', 'eliminar', 'ver detalles', 'ver BD'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'sanctum']);
        }
        
        Permission::firstOrCreate(['name' => 'psicologiaOmaped', 'guard_name' => 'sanctum']);

        // Crear roles para cada área si no existen
        $roles = ['Super Administrador', 'Administrador', 'Área de la Mujer', 'Vaso de Leche', 'SISFOH', 'CIAM', 'OMAPED'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'sanctum']);
        }

        // Crear usuario administrador y asignar rol
        $admin = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Administrador',
            'password' => bcrypt('adminadmin')
        ]);

        // Asignar todos los permisos al rol Administrador
        $adminRole = Role::where('name', 'Administrador')->first();
        $allPermissions = Permission::pluck('name')->toArray();
        $adminRole->syncPermissions($allPermissions); // 🔥 Asigna todos los permisos
        $admin->assignRole($adminRole); // 🔥 Asigna el rol Administrador

        // 🔥 CREAR SÚPER ADMINISTRADOR OCULTO 🔥
        $superAdmin = User::firstOrCreate([
            'email' => 'superadmin@gmail.com'
        ], [
            'name' => 'SuperAdmin',
            'password' => bcrypt('supersecreto123'),
        ]);

        // Asignar todos los permisos al Súper Administrador
        $superAdminRole = Role::where('name', 'Super Administrador')->first();
        $superAdminRole->syncPermissions($allPermissions);
        $superAdmin->assignRole($superAdminRole);

        // Llamar seeders de áreas
        $this->call(AreaDeLaMujerSeeder::class);
        $this->call(VasoDeLecheSeeder::class);
    }
}
