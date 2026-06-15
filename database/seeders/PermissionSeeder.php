<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'vue.acceuil',
            'dashboard.view',
            'gestion.utilisateurs',
            'gestions.roles',
            'gestions.classes',
            'gestions.eleves',
            'gestions.inscriptions',
            'gestions.parents',
            'gestions.resultats',
            'gestions.profiles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $rolePermissions = [
            'Super Admin' => $permissions,
            'Administrateur' => [
                'vue.acceuil',
                'gestion.utilisateurs',
                'gestions.roles',
                'gestions.classes',
                'gestions.eleves',
                'gestions.inscriptions',
                'gestions.parents',
                'gestions.resultats',
                'gestions.profiles',
            ],
            'Secrétaire' => [
                'vue.acceuil',
                'gestions.classes',
                'gestions.eleves',
                'gestions.inscriptions',
                'gestions.parents',
                'gestions.profiles',
            ],
            'Comptable' => [
                'vue.acceuil',
                'gestions.resultats',
                'gestions.profiles',
            ],
            'Enseignant' => [
                'vue.acceuil',
                'gestions.classes',
                'gestions.eleves',
                'gestions.inscriptions',
                'gestions.parents',
                'gestions.profiles',
            ],
            'Élève' => [
                'vue.acceuil',
                'gestions.profiles',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($permissions);
        }
    }
}
