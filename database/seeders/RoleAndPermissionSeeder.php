<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        //  Permission::create(['name' => 'publish articles' ,'guard_name' => 'web']);
        //  Permission::create(['name' => 'unpublish articles' ,'guard_name' => 'web']);
        //  Permission::create(['name' => 'delete any article' ,'guard_name' => 'web']);
        //  Permission::create(['name' => 'delete personal article','guard_name' => 'web']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'super-admin']);
        //  $role->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'muster']);
        //  ->givePermissionTo(['publish articles', 'unpublish articles' ,'delete personal article']);

        $role = Role::create(['name' => 'student']);
        //  ->givePermissionTo([ 'unpublish articles' ]);

    }
}
