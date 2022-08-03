<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([CreateAdminUserSeeder::class]);
        $this->call([TipoEmpresaSeeder::class]);
        $this->call([AcondicionamentosSeeder::class]);
        $this->call([TratamentosSeeder::class]);
        $this->call([ClasseSucatasSeeder::class]);
        $this->call([UnidadesSeeder::class]);
        $this->call([ModelosSeeder::class]);
        $this->call([MarcasSeeder::class]);
        $this->call([EstagiosSeeder::class]);
        $this->call([TipoMaterialesSeeder::class]);
        $this->call([AtividadesSeeder::class]);
        $this->call([IbamasSeeder::class]);
    }
}
