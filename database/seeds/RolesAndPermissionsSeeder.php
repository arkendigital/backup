<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'create article category']);
        Permission::create(['name' => 'edit article category']);
        Permission::create(['name' => 'delete article category']);

        Permission::create(['name' => 'create article']);
        Permission::create(['name' => 'edit article']);
        Permission::create(['name' => 'delete article']);
        Permission::create(['name' => 'publish article']);
        Permission::create(['name' => 'unpublish article']);

        Permission::create(['name' => 'create forum category']);
        Permission::create(['name' => 'edit forum category']);
        Permission::create(['name' => 'delete forum category']);

        Permission::create(['name' => 'create forum']);
        Permission::create(['name' => 'edit forum']);
        Permission::create(['name' => 'delete forum']);

        Permission::create(['name' => 'edit others threads']);
        Permission::create(['name' => 'delete others threads']);
        Permission::create(['name' => 'pin thread']);
        Permission::create(['name' => 'close thread']);

        Permission::create(['name' => 'view report']);
        Permission::create(['name' => 'create report']);
        Permission::create(['name' => 'claim report']);
        Permission::create(['name' => 'close report']);
        Permission::create(['name' => 'open report']);

        Permission::create(['name' => 'view settings']);
        Permission::create(['name' => 'edit settings']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'ban user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);

        $role = Role::create(['name' => 'Super Administrator']);
        $role->givePermissionTo(['create role', 'edit role', 'delete role']);

        $role = Role::create(['name' => 'Administrator']);
        $role->givePermissionTo(['create role', 'edit role']);

        Role::create(['name' => 'Moderator']);
        Role::create(['name' => 'Advanced Member']);
        Role::create(['name' => 'Member']);
        Role::create(['name' => 'Guest']);
    }
}
