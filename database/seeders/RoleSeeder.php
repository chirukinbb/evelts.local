<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    protected $data = [
        'admin' => 'Admin',
        'user' => 'User',
    ];

    public function run()
    {
        foreach ($this->data as $key => $name) {
            $role = Role::create(['name' => $name]);
            $permission = Permission::create(['name' => $key]);
            $role->givePermissionTo($permission);
        }
    }
}
