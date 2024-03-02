<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         Permission::create(['name' => 'publish articles' ,'guard_name' => 'web']);
         Permission::create(['name' => 'unpublish articles' ,'guard_name' => 'web']);
         Permission::create(['name' => 'delete any article' ,'guard_name' => 'web']);
         Permission::create(['name' => 'delete personal article','guard_name' => 'web']);
 
         // create roles and assign created permissions
 
         // this can be done as separate statements
         // or may be done by chaining
         $role = Role::create(['name' => 'admin'])
             ->givePermissionTo(['publish articles', 'unpublish articles' ,'delete personal article']);
 
         $role = Role::create(['name' => 'super-admin']);
         $role->givePermissionTo(Permission::all());
     }
    }

