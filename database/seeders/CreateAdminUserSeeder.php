<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PessoaJuridica;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $pessoa_juridica = PessoaJuridica::create([
        //     'cnpj'=> '45.345.567/0001-45', 
        //     'nome_fantasia'=> 'Hugo Tech',
        //     'razao_social'=> 'VIctor Hugo Ramirez'
        //     'email'=> 'emanuelsert@gmail.com',
        // ]);
    
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@greenbeat.com',
            'password' => 'admin',
            'cpf' => '709.413.992-65',
            'rg' => 'f-72347838'
        ]);
    

        $role = Role::create(['name' => 'admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}