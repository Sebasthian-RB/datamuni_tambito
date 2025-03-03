<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear roles
        $roles = [
            'Administrador',
            'Área de la Mujer',
            'CIAM',
            'SISFOH',
            'OMAPED',
            'Vaso de Leche'
        ];
        
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Crear permisos por área
        $this->createAreaPermissions(
            'Área de la Mujer',
            ['am_people', 'interventions', 'violences', 'programs', 'events', 
             'am_person_interventions', 'am_person_violences', 'am_person_events'],
            ['am_dashboard']
        );

        $this->createAreaPermissions(
            'Vaso de Leche',
            ['committees', 'products', 'sectors', 'vl_family_members', 
             'vl_family_members_products', 'vl_minors', 'committee_vl_family_members'],
            ['vaso-de-leche']
        );

        $this->createAreaPermissions(
            'SISFOH',
            ['enumerators', 'instruments', 'instrument_visits', 'sfh_dwelling_sfh_people',
             'sfh_dwelling', 'sfh_people', 'sfh_requests', 'visits'],
            ['sisfoh_dashboard']
        );

        $this->createAreaPermissions(
            'CIAM',
            ['elderly_adults', 'guardians'],
            ['ciam_home', 'ciam_dashboard']
        );

        $this->createAreaPermissions(
            'OMAPED',
            ['caregivers', 'om-dwellings', 'disabilities', 'om-people'],
            ['om_dashboard']
        );

        // Permisos especiales
        Permission::create(['name' => 'gestionar_usuarios']);

        // Asignar todos los permisos al Administrador
        $admin = Role::findByName('Administrador');
        $admin->givePermissionTo(Permission::all());
    }

    private function createAreaPermissions(string $area, array $resources, array $dashboards)
    {
        $actions = ['ver', 'crear', 'editar', 'eliminar'];
        
        // Permisos para recursos
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::create([
                    'name' => "{$action}_{$resource}"
                ]);
            }
        }

        // Permisos para dashboards
        foreach ($dashboards as $dashboard) {
            Permission::create([
                'name' => "ver_{$dashboard}"
            ]);
        }

        // Asignar permisos al rol
        $role = Role::findByName($area);
        $permissions = Permission::where(function($query) use ($resources, $dashboards) {
            foreach ($resources as $resource) {
                $query->orWhere('name', 'like', "%{$resource}%");
            }
            foreach ($dashboards as $dashboard) {
                $query->orWhere('name', 'like', "%{$dashboard}%");
            }
        })->get();
        
        $role->givePermissionTo($permissions);
    }
}
