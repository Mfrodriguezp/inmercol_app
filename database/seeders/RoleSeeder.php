<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        //Creación de Roles
        $role1 = Role::create(['name' => 'Admin']); //Rol Don David
        $role2 = Role::create(['name' => 'Manager']);//Rol Liz
        $role3 = Role::create(['name' => 'Judge']);//Rol Jueces

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1,$role2,$role3]);
        //Permisos sección Projects
        Permission::create(['name' => 'admin.projects.index'])->syncRoles([$role1,$role2,]);
        Permission::create(['name' => 'admin.projects.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.projects.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.projects.destroy'])->syncRoles([$role1]);
        //Permisos sección jueces
        Permission::create(['name' => 'admin.judges.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.judges.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.judges.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.judges.destroy'])->syncRoles([$role1]);
        //Permisos sección evaluaciones
        Permission::create(['name' => 'admin.evaluateds.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.evaluateds.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.evaluateds.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.evaluateds.destroy'])->syncRoles([$role1]);
        //Permisos sección reportes
        Permission::create(['name' => 'admin.reports.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.reports.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.reports.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.reports.destroy'])->syncRoles([$role1]);
        //Permisos sección Juicios
        Permission::create(['name' => 'admin.judments.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'admin.judments.create'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'admin.judments.edit'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'admin.judments.destroy'])->syncRoles([$role1,$role3]);

    }
}
