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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'courier']);
        Role::create(['name' => 'bakery']);
        Role::create(['name' => 'restaurant']);
        Role::create(['name' => 'market']);
        
        //Permiso del rol client
        Permission::create(['name' => 'realizar pedido']);

        //Permiso provider
        Permission::create(['name' => 'registrar producto']);
        Permission::create(['name' => 'modificar producto']);
        Permission::create(['name' => 'eliminar producto']);
        Permission::create(['name' => 'registrar courier']);

        //Permiso courier
        Permission::create(['name' => 'finalizar pedido']);
    }
}