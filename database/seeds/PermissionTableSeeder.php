<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);

        $routeCollection = \Route::getRoutes();
        foreach ($routeCollection as $route) {
            $route_name = $route->getName();

            if (!is_null($route_name))
                Permission::updateOrCreate(['name' => $route_name]);
        }

        $role->givePermissionTo(Permission::all());
    }
}
