<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class FuncoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // função GDT
        $role_gdt_web = Role::create(['name' => 'GDT', 'guard_name' => 'web']);
        $role_gdt_api = Role::create(['name' => 'GDT', 'guard_name' => 'api']);

        $permissions_gdt_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        $permissions_gdt_api = Permission::where('guard_name', 'api')->pluck('id')->all();

        $role_gdt_web->syncPermissions($permissions_gdt_web);
        $role_gdt_api->syncPermissions($permissions_gdt_api);

        // função Gerador

        $role_gerador_web = Role::create(['name' => 'gerador', 'guard_name' => 'web']);
        $role_gerador_api = Role::create(['name' => 'gerador', 'guard_name' => 'api']);

        $permissions_gerador_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        $permissions_gerador_api = Permission::where('guard_name', 'api')->pluck('id')->all();

        $role_gerador_web->syncPermissions($permissions_gerador_web);
        $role_gerador_api->syncPermissions($permissions_gerador_api);
        
        // função Destinador
        $role_destinador_web = Role::create(['name' => 'destinador', 'guard_name' => 'web']);
        $role_destinador_api = Role::create(['name' => 'destinador', 'guard_name' => 'api']);

        $permissions_destinador_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        $permissions_destinador_api = Permission::where('guard_name', 'api')->pluck('id')->all();

        $role_destinador_web->syncPermissions($permissions_destinador_web);
        $role_destinador_api->syncPermissions($permissions_destinador_api);
        
        // função transportador
        $role_transportador_web = Role::create(['name' => 'transportador', 'guard_name' => 'web']);
        $role_transportador_api = Role::create(['name' => 'transportador', 'guard_name' => 'api']);

        $permissions_transportador_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        $permissions_transportador_api = Permission::where('guard_name', 'api')->pluck('id')->all();

        $role_transportador_web->syncPermissions($permissions_transportador_web);
        $role_transportador_api->syncPermissions($permissions_transportador_api);

        // função Motorista
        $role_motorista_web = Role::create(['name' => 'motorista', 'guard_name' => 'web']);
        $role_motorista_api = Role::create(['name' => 'motorista', 'guard_name' => 'api']);
        
        $permissions_motorista_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        $permissions_motorista_api = Permission::where('guard_name', 'api')->pluck('id')->all();
        
        $role_motorista_web->syncPermissions($permissions_motorista_web);
        $role_motorista_api->syncPermissions($permissions_motorista_api);
        
    }
}