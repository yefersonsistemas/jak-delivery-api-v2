<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsTablesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        Role::truncate();
        Permission::truncate();

        //Roles de usuarios
        Role::create(['name' => 'client']);
        Role::create(['name' => 'provider']);
        Role::create(['name' => 'courier']);
        
        //Permiso del rol director
        Permission::create(['name' => 'ver lista de empleados']);
        Permission::create(['name' => 'registrar empleados']);
        Permission::create(['name' => 'modificar empleados']);
        Permission::create(['name' => 'eliminar empleados']);

    }
}