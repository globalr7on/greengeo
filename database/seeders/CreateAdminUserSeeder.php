<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@greenbeat.com',
            'password' => 'admin',
            'cpf' => '123123', //'709.413.992-65',
            'rg' => 'f-72347838',
            'ativo' => true
        ]);

        $role_web = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role_api = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $permissions_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        $permissions_api = Permission::where('guard_name', 'api')->pluck('id')->all();
        $role_web->syncPermissions($permissions_web);
        $role_api->syncPermissions($permissions_api);
        $user->assignRole($role_web->id, 'web');
        $user->assignRole($role_api->id, 'api');
    }
}